class MakeQuestionnaireRecordsPolymorphic < ActiveRecord::Migration
  def self.up
    change_table :questionnaire_records do |t|
      t.integer :subject_id
      t.string :subject_type
      t.remove :trip_id
      t.remove :activity_id
    end
    delete "TRUNCATE questionnaire_records"  # not worth saving orphaned records
  end

  def self.down
  end
end
