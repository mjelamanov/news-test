<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;

/**
 * Class ShareUserComposer
 *
 * @author Mirlan Jelamanov <mirlan.jelamanov@gmail.com>
 */
class ShareUserComposer
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * ShareUserComposer constructor.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     */
    public function __construct(?Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * Passes an authenticated user instance to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('user', $this->wrapUser());
    }

    /**
     * Wraps an authenticated user via its presenter.
     *
     * @return \App\Presenters\UserPresenter|null
     */
    private function wrapUser(): ?UserPresenter
    {
        return $this->user ? new UserPresenter($this->user) : null;
    }
}
