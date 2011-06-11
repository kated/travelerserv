module TripActivityCommon
  def self.included(base)
    base.class_eval do
      include InstanceMethods
      extend ClassMethods

      has_many :travel_fixes, :order => "id ASC", :as => :parent
      belongs_to :participant
      has_one :questionnaire_record
    end
  end

  module InstanceMethods
    def first_fix_time
      travel_fixes.first.try(:datetime)
    end

    def last_fix_time
      travel_fixes.last.try(:datetime)
    end
  end

  module ClassMethods
    def self.by_day(arel_base = self)
      arel_base.all.group_by{|t| t.travel_fixes.first.try(:datetime).try(:to_date) }.reject!{|k,v| k.nil? }
    end
  end
end