class Trip < ActiveRecord::Base
  include TripActivityCommon

  def self.opposite
    Activity
  end
end
