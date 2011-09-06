module TripActivityCommon
  def self.included(base)
    base.class_eval do
      include InstanceMethods
      extend ClassMethods

      has_many :travel_fixes, :order => "id ASC", :as => :parent do
        def geo_json_line
          collect do |fix|
            [fix.longitude.to_f, fix.latitude.to_f]
          end
        end
      end
      has_many :questionnaire_records, :as => :subject
      belongs_to :participant
      has_one :questionnaire_record, :as => :subject
      before_destroy :move_to_another

      scope :on_date, lambda { |d|
        where(["start BETWEEN ? AND ?", d, (d + 1.day)])
      }
    end
  end

  module InstanceMethods
    def top_left
      [travel_fixes.maximum(:latitude), travel_fixes.minimum(:longitude)]
    end

    def bottom_right
      [travel_fixes.minimum(:latitude), travel_fixes.maximum(:longitude)]
    end

    def first_fix_time
      self.start
    end

    def last_fix_time
      self.end
    end

    def move_to_another
      others = Activity.and_trips_by_day(participant.trips.on_date(self.start.to_date), participant.activities.on_date(self.start.to_date))
      others -= [self]
      return false unless others.any?
      return false
    end
  end

  module ClassMethods
    def self.by_day(arel_base = self)
      arel_base.all.group_by{|t| t.travel_fixes.first.try(:datetime).try(:to_date) }.reject!{|k,v| k.nil? }
    end
  end
end
