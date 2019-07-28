<?php

namespace App\Policies;

use App\User;
use App\School;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

//    public function before($user, $ability)
//    {
//        if ($user->isSuperAdmin()) {
//            return true;
//        }
//    }
    /**
     * Determine whether the user can view any schools.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the school.
     *
     * @param  \App\User $user
     * @param  \App\School $school
     * @return mixed
     */
    public function view(User $user)
    {

        if (in_array('vs', $user->role()->first()->permissions))
            return true;
        else return abort(403, 'متاسفانه اجازه دسترسی به این بخش را ندارید');
    }

    /**
     * Determine whether the user can create schools.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (in_array('cs', $user->role()->first()->permissions))
            return true;
        else return abort(403, 'متاسفانه اجازه دسترسی به این بخش را ندارید');
    }

    /**
     * Determine whether the user can update the school.
     *
     * @param  \App\User $user
     * @param  \App\School $school
     * @return mixed
     */
    public function edit(User $user, School $school)
    {
        $roles = $user->role()->first()->permissions;
        $hoozes = $user->role()->first()->hooze_ids;

        if (in_array('es', $roles) && in_array($school->hooze_namayandegi_id, $hoozes))
            return true;
        else return false;
    }

    /**
     * Determine whether the user can delete the school.
     *
     * @param  \App\User $user
     * @param  \App\School $school
     * @return mixed
     */
    public function delete(User $user, School $school)
    {
        $roles = $user->role()->first()->permissions;
        $hoozes = $user->role()->first()->hooze_ids;

        if (in_array('rs', $roles) && in_array($school->hooze_namayandegi_id, $hoozes))
            return true;
        else return false;
    }

    /**
     * Determine whether the user can restore the school.
     *
     * @param  \App\User $user
     * @param  \App\School $school
     * @return mixed
     */
    public function restore(User $user, School $school)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the school.
     *
     * @param  \App\User $user
     * @param  \App\School $school
     * @return mixed
     */
    public function forceDelete(User $user, School $school)
    {
        //
    }
}
