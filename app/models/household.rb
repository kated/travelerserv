class Household < ActiveRecord::Base
  include HasQuestionnaire

  has_many :participants
end
