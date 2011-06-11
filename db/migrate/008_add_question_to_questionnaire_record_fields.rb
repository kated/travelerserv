class AddQuestionToQuestionnaireRecordFields < ActiveRecord::Migration
  def self.up
    add_column :questionnaire_record_fields, :question, :text
    add_column :questionnaire_record_fields, :question_key, :string
  end

  def self.down
    remove_column :questionnaire_record_fields, :question
    remove_column :questionnaire_record_fields, :question_key
  end
end
