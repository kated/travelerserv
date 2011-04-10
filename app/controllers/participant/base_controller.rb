class Participant::BaseController < ApplicationController
  before_filter :authenticate_participant!
  layout "participant"
end