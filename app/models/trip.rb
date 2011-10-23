class Trip < ActiveRecord::Base
  include TripActivityCommon
  include HasQuestionnaire

  def self.opposite
    Activity
  end
end
