class Participant < ActiveRecord::Base
  has_many :devices
  has_many :travel_fixes
  has_many :trips
  has_many :activities
  has_many :participant_in_studies
  has_many :studies, :through => :participant_in_studies
  has_many :questionnaire_records
  has_many :log_entries
  
  devise :database_authenticatable, :recoverable, :rememberable, :trackable, :validatable
  
  attr_protected :encrypted_password, :password_salt
  
  def full_name
    "#{first_name} #{last_name}"
  end
  
  # for rails_admin
  def title
    self.full_name
  end
end