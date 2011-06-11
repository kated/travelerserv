class Participant::QuestionnaireRecordsController < Participant::BaseController
  before_filter :find_parent
  def new
  end

  private

  def find_parent
    @parent = params[:trip_id] ? current_participant.trips.find(params[:trip_id]) : current_participant.activities.find(params[:activity_id])
  end
end