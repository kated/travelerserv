module HasQuestionnaire
  def self.included(base)
    base.class_eval do
      has_one :questionnaire_record, :as => :subject
      include InstanceMethods
    end
  end

  module InstanceMethods
    
  end
end
