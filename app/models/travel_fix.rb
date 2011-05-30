class TravelFix < ActiveRecord::Base
  belongs_to :device
  belongs_to :participant
  belongs_to :parent, :polymorphic => true
end
