require File.expand_path(File.dirname(__FILE__) + "/../spec_helper")

describe Trip do
  fixtures :all

  describe "#travel_fixes" do
    before do
      @first_fix = travel_fixes(:david_day1_fix3)
      @last_fix = travel_fixes(:david_day1_fix4)
      @participant = participants(:david)
      @trip = trips(:david_day1_driving)
    end

    it "should find all fixes that belong to the trip" do
      fixes = @trip.travel_fixes
      fixes.should include(@first_fix)
      fixes.should include(@last_fix)
      fixes.should_not include(travel_fixes(:david_day1_fix2))
      fixes.should_not include(travel_fixes(:david_day1_fix1))
    end
\
    it "should not include fixes with a different participant" do
      @trip.travel_fixes.should_not include(travel_fixes(:kate_day1_fix1))
    end
  end
end
