<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Reports\Actions\GetOrCreateReportForUser;
use App\Reports\DTOs\GetOrCreateReport;
use App\Reports\ValueObjects\DateString;
use Illuminate\Contracts\Auth\Guard;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private GetOrCreateReportForUser $getOrCreateReportForUser, private Guard $guard)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $user */
        $user = $this->guard->user();

        $report = $this->getOrCreateReportForUser->execute(
            new GetOrCreateReport(
                $user,
                DateString::now()
            )
        );

        return view('home')
            ->with('report', $report);
    }
}
