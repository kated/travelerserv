class AddCheckedToQuestionnaireRecordFields < ActiveRecord::Migration
  def self.up
    add_column :questionnaire_record_fields, :checked, :boolean
  end

  def self.down
    remove_column :questionnaire_record_fields, :checked
  end
end
