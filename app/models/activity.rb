class Activity < ActiveRecord::Base
  include TripActivityCommon
  belongs_to :participant

  def self.and_trips_by_day(trip_scope = Trip, activity_scope = Activity)
    (trip_scope.all + activity_scope.all).
        reject{|o| o.first_fix_time.nil?}.
        sort_by(&:first_fix_time).
        group_by{|t| t.first_fix_time.try(:to_date) }
  end

  def first_fix_time
    self.start
  end

  def last_fix_time
    self.end
  end

end
