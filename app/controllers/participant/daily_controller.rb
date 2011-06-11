class Participant::DailyController < Participant::BaseController
  def show
    @trips_and_activities_by_day = Activity.and_trips_by_day(current_participant.trips, current_participant.activities)
  end
end