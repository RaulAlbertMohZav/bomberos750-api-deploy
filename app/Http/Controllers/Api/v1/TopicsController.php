<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Topics\CreateSubtopicRelationshipTopicRequest;
use App\Http\Requests\Api\v1\Topics\UpdateSubtopicRelationshipTopicRequest;
use App\Models\Opposition;
use App\Models\Question;
use App\Models\Subtopic;
use App\Models\Topic;
use App\Core\Resources\Topics\v1\Interfaces\TopicsInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\v1\Topics\CreateTopicRequest;
use App\Http\Requests\Api\v1\Topics\UpdateTopicRequest;
use App\Http\Requests\Api\v1\Topics\ActionForMassiveSelectionTopicsRequest;
use App\Http\Requests\Api\v1\Topics\ExportTopicsRequest;
use App\Http\Requests\Api\v1\Topics\ImportTopicsRequest;

class TopicsController extends Controller
{
    protected TopicsInterface $topicsInterface;

    public function __construct(TopicsInterface $topicsInterface ){
        $this->topicsInterface = $topicsInterface;
    }

    public function index(){
        return $this->topicsInterface->index();
    }

    public function create(CreateTopicRequest $request){
        return $this->topicsInterface->create($request);
    }

    public function read(Topic $topic){
        return $this->topicsInterface->read( $topic );
    }

    public function update(UpdateTopicRequest $request, Topic $topic){
        return $this->topicsInterface->update( $request, $topic );
    }

    public function delete(Topic $topic){
        return $this->topicsInterface->delete( $topic );
    }

    public function action_for_multiple_records(ActionForMassiveSelectionTopicsRequest $request): string{
        return $this->topicsInterface->action_for_multiple_records( $request );
    }

    public function export_records(ExportTopicsRequest $request){
        return $this->topicsInterface->export_records( $request );
    }

    public function import_records(ImportTopicsRequest $request){
        return $this->topicsInterface->import_records( $request );
    }

    public function download_template_import_records (): \Symfony\Component\HttpFoundation\StreamedResponse {
        return Storage::disk('public')->download('templates_import/topic.csv', 'template_import_topic');
    }

    public function get_relationship_subtopics (Topic $topic) {
        return $this->topicsInterface->get_relationship_subtopics($topic);
    }

    public function get_relationship_oppositions (Topic $topic) {
        return $this->topicsInterface->get_relationship_oppositions($topic);
    }

    public function get_relationship_a_subtopic (Topic $topic, Subtopic $subtopic) {
        return $this->topicsInterface->get_relationship_a_subtopic($topic, $subtopic);
    }
    public function get_relationship_a_opposition (Topic $topic, Opposition $opposition) {
        return $this->topicsInterface->get_relationship_a_opposition($topic, $opposition);
    }

    public function get_relationship_questions (Topic $topic) {
        return $this->topicsInterface->get_relationship_questions($topic);
    }

    public function get_relationship_a_question (Topic $topic, Question $question) {
        return $this->topicsInterface->get_relationship_a_question($topic, $question);
    }

    public function subtopics_get_relationship_questions (Topic $topic, Subtopic $subtopic) {
        return $this->topicsInterface->subtopics_get_relationship_questions($topic, $subtopic);
    }

    public function subtopics_get_relationship_a_question (Topic $topic, Subtopic $subtopic, Question $question) {
        return $this->topicsInterface->subtopics_get_relationship_a_question($topic, $subtopic, $question);
    }

    public function create_relationship_subtopic (CreateSubtopicRelationshipTopicRequest $request,Topic $topic) {
        return $this->topicsInterface->create_relationship_subtopic($request, $topic);
    }

    public function update_relationship_subtopic (UpdateSubtopicRelationshipTopicRequest $request,Topic $topic, Subtopic $subtopic) {
        return $this->topicsInterface->update_relationship_subtopic($request, $topic, $subtopic);
    }

    public function delete_relationship_subtopic (Topic $topic, Subtopic $subtopic) {
        return $this->topicsInterface->delete_relationship_subtopic($topic, $subtopic);
    }
}
