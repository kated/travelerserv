require File.expand_path(File.dirname(__FILE__) + "/../spec_helper")

describe Trip do
  fixtures :all
  describe "#travel_fixes" do
    before do
      @first_fix = travel_fixes(:david_day1_fix1)
      @last_fix = travel_fixes(:david_day1_fix3)
      @participant = participants(:david)
      @trip = Trip.create!(:start_travel_fix_id => @first_fix.id, :end_travel_fix_id => @last_fix.id, :participant => @participant)
    end

    it "should find all fixes with ID between the start ID and end ID" do
      fixes = @trip.travel_fixes
      fixes.should include(@first_fix)
      fixes.should include(travel_fixes(:david_day1_fix2))
      fixes.should include(@last_fix)
      fixes.should_not include(travel_fixes(:david_day1_fix4))
    end

    it "should not include fixes with a different participant" do
      @trip.travel_fixes.should_not include(travel_fixes(:kate_day1_fix1))
    end
  end
end
