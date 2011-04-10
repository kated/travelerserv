class Participant::DailyController < Participant::BaseController
  def show
    @trips_by_day = Trip.by_day
  end
end