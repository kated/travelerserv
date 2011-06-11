class Participant::QuestionnaireRecordsController < Participant::BaseController
  before_filter :find_parent
  def new
    @questionnaire_record = QuestionnaireRecord.new(:participant => current_participant)
  end

  def create
    @questionnaire_record = @parent.build_questionnaire_record(params[:question_record])
    @questionnaire_record.participant = current_participant
    if @questionnaire_record.save

    end
  end

  private

  def find_parent
    @parent = params[:trip_id] ? current_participant.trips.find(params[:trip_id]) : current_participant.activities.find(params[:activity_id])
  end
end