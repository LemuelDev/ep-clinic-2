<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
{
    // Check specifically for the exception thrown by the throttle middleware
    if ($exception instanceof ThrottleRequestsException) {
        
        // Calculate the time remaining before the user can try again
        // Note: The 'Retry-After' header often contains the seconds remaining.
        
        $seconds = $exception->getHeaders()['Retry-After'] ?? null;
        $minutes = ceil($seconds / 60); // Convert seconds to minutes, rounded up
        
        $errorMessage = "You have attempted to submit an appointment too many times. Please try again later.";

        // 1. Log the event (optional, but good practice)
        Log::warning("IP Rate Limit Hit: " . $request->ip());

        // 2. Redirect back to the form with the error message
        return redirect()->back()->with('throttle_error', $errorMessage);
    }

    return parent::render($request, $exception);
}

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
