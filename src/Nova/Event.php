<?php

namespace Creode\LaravelNovaEvents\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Creode\NovaPublishable\Published;
use Laravel\Nova\Http\Requests\NovaRequest;
use Creode\NovaPublishable\Nova\PublishAction;
use Creode\NovaPublishable\Nova\UnpublishAction;

class Event extends Resource
{
    /**
     * The model the resource corresponds to.
     */
    public static $model = \Creode\LaravelNovaEvents\Entities\Event::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title',
    ];

    public static $group = 'Events';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Published::make('Published', 'published_at'),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Slug::make('Slug')->from('Title'),

            Date::make('Start Date')
                ->sortable()
                ->rules('required', 'date'),

            Date::make('End Date')
                ->sortable()
                ->rules('nullable', 'date', 'after_or_equal:start_date'),

            Text::make('Venue')
                ->hideFromIndex(),

            Markdown::make('Address')
                ->hideFromIndex(),

            URL::make('Button Link', 'cta_link')
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new PublishAction)
                ->confirmText('Are you sure you want to publish these items?')
                ->confirmButtonText('Publish')
                ->cancelButtonText("Don't Publish"),

            (new UnpublishAction)
                ->confirmText('Are you sure you want to unpublish these items?')
                ->confirmButtonText('Unpublish')
                ->cancelButtonText("Don't Unpublish")
        ];
    }
}
