class Trip < ActiveRecord::Base
  belongs_to :participant
  has_many :questionnaire_records
  has_many :travel_fixes, :as => :parent

  def self.by_day(arel_base = Trip)
    arel_base.all.group_by{|t| t.start_travel_fix.datetime.to_date }
  end
end