class Trip < ActiveRecord::Base
  has_many :activities
  belongs_to :participant
  belongs_to :start_travel_fix, :class_name => "TravelFix"
  belongs_to :end_travel_fix, :class_name => "TravelFix"
  has_many :questionnaire_records

  def travel_fixes
    TravelFix.where(["id BETWEEN ? AND ?", start_travel_fix_id, end_travel_fix_id]).where(:participant_id => participant_id)
  end

  def self.by_day(arel_base = Trip)
    arel_base.all.group_by{|t| t.start_travel_fix.datetime.to_date }
  end
end