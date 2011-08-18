class Participant::DailyController < Participant::BaseController
  def index
    @trips_and_activities_by_day = Activity.and_trips_by_day(current_participant.trips, current_participant.activities)
  end

  def show
    @date = Time.parse(params[:id]).to_date
    @trips_and_activities_by_day = Activity.and_trips_by_day(current_participant.trips.on_date(@date), current_participant.activities.on_date(@date))
  end
end
