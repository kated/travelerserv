class Participant::TripsController < Participant::BaseController
  def update
    @trip = Trip.find(params[:id])
    @trip.update_attributes!(params[:trip])
    redirect_to participant_daily_path(@trip.start.to_date)
  end

  def destroy
    @trip = Trip.find(params[:id])
    if @trip.remove_and_merge!
      flash[:notice] = "Successfully removed trip"
    else      
      flash[:alert] = "Cannot remove trip"
    end
    redirect_to participant_daily_path(@trip.start.to_date)
  end
end
