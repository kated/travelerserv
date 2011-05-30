class Activity < ActiveRecord::Base
  has_many :travel_fixes, :as => :parent
  belongs_to :participant
  has_many :questionnaire_records
end