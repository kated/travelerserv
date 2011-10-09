class Participant::ActivitiesController < Participant::BaseController
  def update
    @activity = Activity.find(params[:id])
    @activity.update_attributes!(params[:activity])
    redirect_to participant_daily_path(@activity.start.to_date)
  end

  def destroy
    @activity = Activity.find(params[:id])
    if @activity.remove_and_merge!
      flash[:notice] = "Successfully removed activity"
    else      
      flash[:alert] = "Cannot remove activity"
    end
    redirect_to participant_daily_path(@activity.start.to_date)
  end
end
