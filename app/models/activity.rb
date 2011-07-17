class Activity < ActiveRecord::Base
  include TripActivityCommon
  belongs_to :participant

  def self.and_trips_by_day(trip_scope = Trip, activity_scope = Activity)
    (trip_scope.all + activity_scope.all).
        reject{|o| o.first_fix_time.nil?}.
        sort_by(&:first_fix_time).
        group_by{|t| t.travel_fixes.first.try(:datetime).try(:to_date) }
  end

end
