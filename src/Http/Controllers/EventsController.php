<?php

namespace Creode\LaravelNovaEvents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Creode\LaravelNovaEvents\Entities\Event;
use Creode\LaravelNovaEvents\Entities\EventCategory;
use Creode\LaravelNovaEvents\Entities\EventSubCategory;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $categories = EventCategory::with('sub_categories')->get();

        if ($request->query('events') == 'past') {
            $events = Event::postEvents()->get();
        } else {
            $events = Event::upcomingEvents()->get();
        }

        return view('events::index', compact('categories', 'events'));
    }

    /**
     * Show the specified resource.
     *
     * @param EventCategory $eventCategory
     * @return Renderable
     */
    public function categoryShow(EventCategory $eventCategory, Request $request)
    {
        $eventCategory->load([
        'sub_categories.events' => function ($query) use ($request) {
            if ($request->query('events') == 'past') {
                $query->pastEvents();
            } else {
                $query->upcomingEvents();
            }
        },
        ]);

        $categories = EventCategory::with('sub_categories.events')->get();
        return view('events::categoryShow', compact('eventCategory', 'categories'));
    }

    /**
     * Show the specified resource.
     *
     * @param EventSubCategory $eventSubCategory
     * @param EventCategory $eventCategory
     * @return Renderable
     */

    public function subCategoryShow(EventCategory $eventCategory, EventSubCategory $eventSubCategory, Request $request)
    {
        $eventSubCategory->load([
        'events' => function ($query) use ($request) {
            if ($request->query('events') == 'past') {
                $query->pastEvents();
            } else {
                $query->upcomingEvents();
            }
        },
        ]);
        $categories = EventCategory::with('sub_categories')->get();
        return view('events::subCategoryShow', compact('eventSubCategory', 'categories'));
    }
}
