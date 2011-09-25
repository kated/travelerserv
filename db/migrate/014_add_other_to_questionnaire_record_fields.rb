class AddOtherToQuestionnaireRecordFields < ActiveRecord::Migration
  def self.up
    add_column :questionnaire_record_fields, :other, :boolean
  end

  def self.down
    remove_column :questionnaire_record_fields, :other
  end
end
