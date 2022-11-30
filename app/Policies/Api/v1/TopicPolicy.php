<?php

namespace App\Policies\Api\v1;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Topic;
use App\Models\User;

class TopicPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->can('list-topics');
    }

    public function read(User $user, Topic $topic): bool
    {
        return $user->can('see-a-topic');
    }

    public function create(User $user): bool
    {
        return $user->can('create-topic');
    }

    public function update(User $user, Topic $topic): bool
    {
        return $user->can('edit-topic');
    }

    public function delete(User $user, Topic $topic): bool
    {
        return $user->can('delete-topic');
    }

    public function mass_selection_for_action(User $user): bool
    {
        return $user->can('action-for-multiple-topics');
    }

    public function get_relationship_subtopics (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }


    public function get_relationship_oppositions (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function get_relationship_a_subtopic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }
    public function get_relationship_a_opposition (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function get_relationship_questions (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function get_relationship_a_question (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function subtopics_get_relationship_questions (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function subtopics_get_relationship_a_question (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function create_relationship_subtopic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function update_relationship_subtopic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function delete_relationship_subtopic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function get_oppositions_available_of_topic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function assign_opposition_with_subtopics_to_topic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function update_subtopics_opposition_by_topic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function delete_opposition_by_topic (User $user, Topic $topic): bool {
        return $user->can("see-a-topic");
    }

    public function export_records(User $user): bool
    {
        return true;
    }
    public function import_records(User $user): bool
    {
        return true;
    }
}
