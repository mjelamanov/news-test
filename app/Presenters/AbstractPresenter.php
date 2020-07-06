<?php

declare(strict_types=1);

namespace App\Presenters;

use Hemp\Presenter\Presenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class AbstractPresenter
 *
 * @author Mirlan Jelamanov <mirlan.jelamanov@gmail.com>
 */
abstract class AbstractPresenter extends Presenter
{
    /**
     * AbstractPresenter constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        parent::__construct($model);

        $this->wrapRelations();
    }

    /**
     * Creates a presenter from a paginated collection.
     *
     * @param \Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\Paginator $paginator
     *
     * @return \Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\Paginator
     */
    public static function createFromPaginator($paginator)
    {
        return tap($paginator, function ($paginator) {
            $items = $paginator->getCollection()->mapInto(static::class);
            $paginator->setCollection($items);
        });
    }

    /**
     * Wraps loaded relations by their presenters if exists.
     *
     * @return void
     */
    protected function wrapRelations(): void
    {
        foreach ($this->model->getRelations() as $name => $relation) {
            $presenter = __NAMESPACE__ . '\\' . Str::studly(Str::singular($name)) . 'Presenter';

            if (!class_exists($presenter)) {
                continue;
            }

            if ($relation instanceof Model) {
                $this->model->setRelation($name, new $presenter($relation));
            } elseif ($relation instanceof Collection) {
                $this->model->setRelation($name, call_user_func([$presenter, 'collection'], $relation));
            }
        }
    }
}
