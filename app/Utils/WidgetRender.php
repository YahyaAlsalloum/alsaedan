<?php


namespace App\Utils;

use App\Models\Site;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;
use Yajra\DataTables\DataTables;


trait WidgetRender
{
    public function renderDataTable(Builder $builder, $actions = [], $baseRoute = null, $innerTable = false)
    {
        $model = $this;
        foreach ($model->fields as $field) {
            if (Arr::has($field, 'chains')) {
                $builder->with($field['chains']);
            }
        }

        $route = $model->route;
        $datatable = Datatables::of($builder)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($model, $route, $actions, $baseRoute,$innerTable) {
                if ($innerTable) {
                    if ($baseRoute != null) {
                        $btn = view(
                            'cms.layouts.datatable.sub-actions',
                            [
                                'ob' => $row,
                                'actions' => $actions,
                                'baseRoute' => $baseRoute
                            ]
                        );
                    } else {
                        $btn = view(
                            'cms.layouts.datatable.sub-actions',
                            [
                                'route' => $route,
                                'ob' => $row,
                                'actions' => $actions,
                            ]
                        );
                    }
                } else {
                    if ($baseRoute != null) {
                        $btn = view(
                            'cms.layouts.datatable.actions',
                            [
                                'ob' => $row,
                                'actions' => $actions,
                                'baseRoute' => $baseRoute
                            ]
                        );
                    } else {
                        $btn = view(
                            'cms.layouts.datatable.actions',
                            [
                                'route' => $route,
                                'ob' => $row,
                                'actions' => $actions,
                            ]
                        );
                    }
                }


                return $btn;
            })->rawColumns(['action']);

        foreach ($model->fields as $field)
            $datatable->addColumn($field['key'], function ($row) use ($field) {
                switch ($field['type']) {
                    case 'field':
                        return !isset($field['show']) ? $row->{$field['key']} : $field['show'][$row->{$field['key']}];
                        break;
                    case 'object':
                        try {
                            return $row->{$field['key']}->{$field['show']};
                        } catch (Exception $e) {
                            return '';
                        }
                        break;
                }

                return '';
            });

        return $datatable->make(true);
    }

    public function renderForm($action, $updateId = 0, $isShow = 0, $forPublishing = false, $remove_indices = [])
    {
        $elements = '';
        $method = 'POST';
        $validations = "";
        $model = null;

        if ($updateId != 0) {
            $method = 'PUT';
            $model = $this->findOrFail($updateId);
        }

        foreach ($this->formFields as $name => $parameters) {
            if (in_array($name, $remove_indices))
                continue;

            if (isset($model) && !isset($parameters['pivot_reference'])) {
                $parameters['value'] = isset($parameters['concat_before']) ? $parameters['concat_before'] . $model->{$name} : $model->{$name};

                if (isset($parameters['type']) && $parameters['type'] == 'password')
                    $parameters['value'] = "";
            } elseif (isset($model) && isset($parameters['pivot_reference'])) {
                if ($model->{$parameters['pivot_reference']} != null) {
                    try {
                        $parameters['value'][] = $model->{$parameters['pivot_reference']}->_id;
                    } catch (Exception $exception) {

                        foreach ($model->{$parameters['pivot_reference']} as $ref) {
                            try {
                                $parameters['value'][] = $ref->_id;
                            } catch (Exception $exception) {
                            }
                        }
                    }
                }
            }

            if (isset($parameters['eval_value'])) {
                $parameters['eval_value'];
                ob_start();
                $parameters['value'] = ob_get_contents();
                ob_end_clean();
            }

            if (isset($parameters['references'])) {
                if (!is_array($parameters['references'])) {

                    if (!isset($parameters['chains']))
                        $parameters['chains'] = ['all'];
                    $options = $this->call_func(
                        new $parameters['references'],
                        $parameters['chains'],
                        $model == null ? null : $model
                    );
                    //                    Log::info($options);
                    if (isset($parameters['concat']))
                        foreach ($options->values() as $option) {
                            $display = "";
                            $object = $option;
                            foreach ($parameters['concat'] as $slice) {
                                if (!strpos($slice, '%s')) {
                                    $explodedSlice = explode('.', $slice);
                                    foreach ($explodedSlice as $subSlice)
                                        $object = $object->{$subSlice};
                                    $display .= $object;
                                    $object = $option; //reset the object
                                    //                                    dd($display);
                                } else {
                                    $display .= $slice;
                                }
                            }

                            //                            $option->{$parameters['displayMember']} = sprintf($display, $option->{$parameters['displayMember']});
                            $option->display = sprintf($display, $option->{$parameters['displayMember']}); //->display is because of the concats when conflicted with an accessor
                        }

                    $parameters['options'] = $options;
                } else {
                    $parameters['options'] = $parameters['references'];
                }
            }
            $isEdit = []; //used currently to check if there is a pass field on edit form for unauth user
            $isEdit = isset($model) ? ['isEdit' => true] : [];
            $elements .= view('cms.layouts.form.elements.' . $parameters['input'], $parameters, array_merge(['isShow' => $isShow], $isEdit));
            $validations .= isset($parameters['validations']) ? $parameters['validations'] . ';' : "";
        }

        try {
            $form = view('cms.layouts.form.widget', compact('elements', 'action', 'method', 'isShow', 'forPublishing'));
            //            $form['validations'] = $validations; for later use
            return $form->render();
        } catch (Throwable $e) {
            return dd($e);
        }
    }

    private function call_func($object, $chains, $model = null)
    {
        foreach ($chains as $chain => $value) {
            if ($value == "get" && $model != null) {
                $object->where('_id', '!=', $model->_id);
            }
            //            if ( $value == "get" ){
            //                Log::info($object->get());
            //            }

            if (is_array($value))
                $object = !is_numeric($chain) ?
                    $object->{$chain}(...$value) :
                    $object->{$value}();
            else
                $object = !is_numeric($chain) ?
                    $object->{$chain}($value)
                    : $object->{$value}();
            //if the array element in associative then the key is the function name and the value is parameter
        }

        return $object;
    }
}
