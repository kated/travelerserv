class Participant::QuestionnaireRecordsController < Participant::BaseController
  before_filter :find_parent
  def new
    @questionnaire_record = QuestionnaireRecord.new(:participant => current_participant)
  end

  def create
    @questionnaire_record = @parent.build_questionnaire_record(params[:questionnaire_record])
    @questionnaire_record.participant = current_participant
    if @questionnaire_record.save
      redirect_to root_path
    else
      render :action => "new"
    end
  end

  def edit
    @questionnaire_record = @parent.questionnaire_record
  end

  def update
    @questionnaire_record = @parent.questionnaire_record
    @questionnaire_record.attributes = params[:questionnaire_record]
    if @questionnaire_record.save
      redirect_to root_path
    else
      render :action => "edit"
    end
  end

  private

  def find_parent
    @parent = params[:trip_id] ? current_participant.trips.find(params[:trip_id]) : current_participant.activities.find(params[:activity_id])
  end
end
