class Participant::TripsController < Participant::BaseController
  def update
    @trip = Trip.find(params[:id])
    @trip.update_attributes!(params[:trip])
    redirect_to participant_daily_path(@trip.start.to_date)
  end

  def destroy
    @trip = Trip.find(params[:id])
  end
end
