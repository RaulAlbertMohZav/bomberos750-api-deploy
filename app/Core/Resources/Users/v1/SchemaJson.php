<?php
namespace App\Core\Resources\Users\v1;

use App\Http\Resources\Api\Question\v1\QuestionCollection;
use App\Http\Resources\Api\Questionnaire\v1\QuestionnaireCollection;
use App\Http\Resources\Api\Topic\v1\TopicCollection;
use App\Models\User;
use App\Core\Resources\Users\v1\Interfaces\UsersInterface;
use App\Http\Resources\Api\User\v1\UserCollection;
use App\Http\Resources\Api\User\v1\UserResource;
use Illuminate\Support\Str;

class SchemaJson implements UsersInterface
{
    protected EventApp $eventApp;

    public function __construct(\App\Core\Resources\Users\v1\EventApp $eventApp ){
        $this->eventApp = $eventApp;
    }

    public function index(): UserCollection
    {
        return UserCollection::make(
            $this->eventApp->index()
        );
    }

    public function create( $request ): \Illuminate\Http\JsonResponse
    {
        return UserResource::make($this->eventApp->create($request))
                    ->response()
                    ->setStatusCode(201);
    }

    public function read( $user ): UserResource
    {
        return UserResource::make(
            $this->eventApp->read( $user )
        );
    }

    public function update( $request, $user ): UserResource
    {
        return UserResource::make(
            $this->eventApp->update( $request, $user )
        );
    }

    public function delete( $user ): \Illuminate\Http\Response
    {
        $this->eventApp->delete( $user );
        return response()->noContent();
    }

    public function mass_selection_for_action( $request ): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'information' => $this->eventApp->mass_selection_for_action( $request )
        ], 200);
    }

    public function export_records( $request ){
        return $this->eventApp->export_records( $request );
    }

    public function import_records( $request ){
        return $this->eventApp->import_records( $request );
    }

    public function disable_account($request, $user): UserResource
    {
        return UserResource::make(
            $this->eventApp->disable_account($request, $user)
        );
    }

    public function enable_account($request, $user): UserResource
    {
        return UserResource::make(
            $this->eventApp->enable_account($request, $user)
        );
    }

    public function contactsUS($request)
    {
        return response()->json([
            'data' => $this->eventApp->contactsUS($request)
        ]);
    }

    public function get_history_statistical_data_graph_by_student($request)
    {
        return response()->json([
            'data' => $this->eventApp->get_history_statistical_data_graph_by_student($request)
        ]);
    }

    public function fetch_history_questions_by_type_and_period($request)
    {

        return QuestionCollection::make(
            $this->eventApp->fetch_history_questions_by_type_and_period($request)
        );
    }

    public function fetch_history_questions_wrong_by_topic_of_student($topic)
    {
        return QuestionCollection::make(
            $this->eventApp->fetch_history_questions_wrong_by_topic_of_student($topic)
        );
    }

    public function fetch_history_tests_completed_by_student()
    {
        return QuestionnaireCollection::make(
            $this->eventApp->fetch_history_tests_completed_by_student()
        );
    }

    public function fetch_topics_available_in_tests()
    {
        return TopicCollection::make(
            $this->eventApp->fetch_topics_available_in_tests()
        );
    }
}
