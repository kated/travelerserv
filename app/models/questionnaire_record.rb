class QuestionnaireRecord < ActiveRecord::Base
  belongs_to :participant
  belongs_to :questionnaire
  has_many :questionnaire_record_fields
  accepts_nested_attributes_for :questionnaire_record_fields
  belongs_to :activity
  belongs_to :trip
end
