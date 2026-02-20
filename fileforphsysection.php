   <div class="step mb-5" id="step17">
                <div class="screener " id="pre_primary">
                    <h3 class="title">PRE-PRIMARY PSYCHOLOGICAL SCREENER</h3>

                    <div >
                        <h4 class="subTitle mt-3">DEVELOPMENTAL SCREENING</h4>
                        <div id="playgound_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 12–24.9 Months</li>
                                <li><strong>Grade:</strong> Play Group</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                           <strong> Cognitive:  </strong>  Does your child try to solve problems, like figuring out how to get a toy from a
                                            box?
                                        </label>
                                        <select name="QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box" class="playground-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Yes') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'Yes' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Sometimes') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'Sometimes' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $_GET['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'No') || old('QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box') == 'No' || (isset($details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box']) && $details['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong> Cognitive:  </strong>  Does your child imitate household tasks (e.g., sweeping, talking on phone)?
                                           
                                        </label>
                                        <select name="QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone" class="playground-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Yes') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'Yes' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                             <option value="Sometimes" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Sometimes') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'Sometimes' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $_GET['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'No') || old('QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone') == 'No' || (isset($details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone']) && $details['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] == 'No') ? 'selected' : '' }}>No</option>  
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden score fields for calculation only -->
                                <input type="hidden" name="play_ground_Cognitive" id="play_ground_Cognitive">
                                <input type="hidden" name="play_ground_Motor" id="play_ground_Motor">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child walk without help?
                                        </label>
                                        <select name="QuestionNo_61_Can_your_child_walk_without_help" class="playground-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'Yes') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'Yes' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'Sometimes') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'Sometimes' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                              <option value="No" {{ (isset($_GET['QuestionNo_61_Can_your_child_walk_without_help']) && $_GET['QuestionNo_61_Can_your_child_walk_without_help'] == 'No') || old('QuestionNo_61_Can_your_child_walk_without_help') == 'No' || (isset($details['QuestionNo_61_Can_your_child_walk_without_help']) && $details['QuestionNo_61_Can_your_child_walk_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child stack two or more blocks? 
                                        </label>
                                        <select name="QuestionNo_62_Can_your_child_stack_two_or_more_blocks" class="playground-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Yes') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'Yes' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Sometimes') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'Sometimes' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $_GET['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'No') || old('QuestionNo_62_Can_your_child_stack_two_or_more_blocks') == 'No' || (isset($details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks']) && $details['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>   <label>Does your child point to objects when named?</label>
                                        <select name="QuestionNo_63_Does_your_child_point_to_objects_when_named" class="playground-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Yes') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'Yes' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Sometimes') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'Sometimes' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $_GET['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'No') || old('QuestionNo_63_Does_your_child_point_to_objects_when_named') == 'No' || (isset($details['QuestionNo_63_Does_your_child_point_to_objects_when_named']) && $details['QuestionNo_63_Does_your_child_point_to_objects_when_named'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>    Can your child say at least 5–10 words?
                                        </label>
                                        <select name="QuestionNo_64_Can_your_child_say_at_least_5_10_words" class="playground-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Yes') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'Yes' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Sometimes') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'Sometimes' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $_GET['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'No') || old('QuestionNo_64_Can_your_child_say_at_least_5_10_words') == 'No' || (isset($details['QuestionNo_64_Can_your_child_say_at_least_5_10_words']) && $details['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Language & Social-Emotional score fields -->
                                <input type="hidden" name="play_ground_Language" id="play_ground_Language">
                                <input type="hidden" name="play_ground_SocialEmotional" id="play_ground_SocialEmotional">
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>      Does your child show affection to familiar people?
                                        </label>
                                        <select name="QuestionNo_65_Does_your_child_show_affection_to_familiar_people" class="playground-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Yes') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'Yes' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Sometimes') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'Sometimes' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $_GET['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'No') || old('QuestionNo_65_Does_your_child_show_affection_to_familiar_people') == 'No' || (isset($details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people']) && $details['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child get upset when separated from you? 
                                        </label>
                                        <select name="QuestionNo_66_Does_your_child_get_upset_when_separated_from_you" class="playground-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Yes') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'Yes' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Sometimes') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'Sometimes' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $_GET['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'No') || old('QuestionNo_66_Does_your_child_get_upset_when_separated_from_you') == 'No' || (isset($details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you']) && $details['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>  Can your child feed themselves with fingers or a spoon?
                                        </label>
                                        <select name="QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon" class="playground-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Yes') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'Yes' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Sometimes') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'Sometimes' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $_GET['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'No') || old('QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon') == 'No' || (isset($details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon']) && $details['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>    Does your child try to brush teeth or wash hands with help?
                                        </label>
                                        <select name="QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help" class="playground-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Yes') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'Yes' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Sometimes') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'Sometimes' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $_GET['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'No') || old('QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help') == 'No' || (isset($details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help']) && $details['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                             
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Cognitive_Result" id="play_ground_Cognitive_Result" value="{{ $details['play_ground_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_cognitive_total_score" id="playground_cognitive_total_score" value="{{ $details['playground_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Motor_Result" id="play_ground_Motor_Result" value="{{ $details['play_ground_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_motor_total_score" id="playground_motor_total_score" value="{{ $details['playground_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Language_Result" id="play_ground_Language_Result" value="{{ $details['play_ground_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_language_total_score" id="playground_language_total_score" value="{{ $details['playground_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_SocialEmotional_Result" id="play_ground_SocialEmotional_Result" value="{{ $details['play_ground_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_social_emotional_total_score" id="playground_social_emotional_total_score" value="{{ $details['playground_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result:</strong></label>
                                        <input type="text" class="form-control" name="play_ground_Adaptive_Result" id="play_ground_Adaptive_Result" value="{{ $details['play_ground_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_adaptive_total_score" id="playground_adaptive_total_score" value="{{ $details['playground_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Playground Total Score:</strong></label>
                                        <input type="text" class="form-control" name="playground_total_score" id="playground_total_score" value="{{ $details['playground_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div id="nursary_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 25–36.9 Months</li>
                                <li><strong>Grade:</strong> Nursery</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                          <strong>Cognitive: </strong>  Can your child complete a simple puzzle (e.g., 3–4 pieces)?
                                        </label>
                                        <select name="QuestionNo_69_Can_your_child_complete_a_simple_puzzle" class="nursery-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Yes') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'Yes' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Sometimes') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'Sometimes' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $_GET['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'No') || old('QuestionNo_69_Can_your_child_complete_a_simple_puzzle') == 'No' || (isset($details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle']) && $details['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] == 'No') ? 'selected' : '' }}>No</option>                                         
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive: </strong>  Does your child match similar objects (e.g., shoes, animals)?
                                           
                                        </label>
                                        <select name="QuestionNo_70_Does_your_child_match_similar_objects" class="nursery-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Yes') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'Yes' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Sometimes') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'Sometimes' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_70_Does_your_child_match_similar_objects']) && $_GET['QuestionNo_70_Does_your_child_match_similar_objects'] == 'No') || old('QuestionNo_70_Does_your_child_match_similar_objects') == 'No' || (isset($details['QuestionNo_70_Does_your_child_match_similar_objects']) && $details['QuestionNo_70_Does_your_child_match_similar_objects'] == 'No') ? 'selected' : '' }}>No</option>                                            
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Cognitive and Motor score fields -->
                                <input type="hidden" name="nursery_Cognitive" id="nursery_Cognitive">
                                <input type="hidden" name="nursery_Motor" id="nursery_Motor">
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>   Can your child jump with both feet?
                                        </label>
                                        <select name="QuestionNo_71_Can_your_child_jump_with_both_feet" class="nursery-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Yes') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'Yes' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Sometimes') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'Sometimes' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $_GET['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'No') || old('QuestionNo_71_Can_your_child_jump_with_both_feet') == 'No' || (isset($details['QuestionNo_71_Can_your_child_jump_with_both_feet']) && $details['QuestionNo_71_Can_your_child_jump_with_both_feet'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>     Can your child draw a line or circle? 
                                        </label>
                                        <select name="QuestionNo_72_Can_your_child_draw_a_line_or_circle" class="nursery-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Yes') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'Yes' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Sometimes') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'Sometimes' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $_GET['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'No') || old('QuestionNo_72_Can_your_child_draw_a_line_or_circle') == 'No' || (isset($details['QuestionNo_72_Can_your_child_draw_a_line_or_circle']) && $details['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>   <label>Can your child form 2- to 3-word phrases (e.g., “want juice”)?</label>
                                        <select name="QuestionNo_73_Can_your_child_form_2_to_3_word_phrases" class="nursery-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Yes') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'Yes' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Sometimes') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'Sometimes' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $_GET['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'No') || old('QuestionNo_73_Can_your_child_form_2_to_3_word_phrases') == 'No' || (isset($details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases']) && $details['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>   Does your child ask simple questions like “What’s that?”
                                            
                                        </label>
                                        <select name="QuestionNo_74_Does_your_child_ask_simple_questions" class="nursery-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Yes') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'Yes' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Sometimes') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'Sometimes' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_74_Does_your_child_ask_simple_questions']) && $_GET['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'No') || old('QuestionNo_74_Does_your_child_ask_simple_questions') == 'No' || (isset($details['QuestionNo_74_Does_your_child_ask_simple_questions']) && $details['QuestionNo_74_Does_your_child_ask_simple_questions'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child play pretend (e.g., feeding a doll)?
                                        </label>
                                        <select name="QuestionNo_75_Does_your_child_play_pretend" class="nursery-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'Yes') || old('QuestionNo_75_Does_your_child_play_pretend') == 'Yes' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'Sometimes') || old('QuestionNo_75_Does_your_child_play_pretend') == 'Sometimes' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_75_Does_your_child_play_pretend']) && $_GET['QuestionNo_75_Does_your_child_play_pretend'] == 'No') || old('QuestionNo_75_Does_your_child_play_pretend') == 'No' || (isset($details['QuestionNo_75_Does_your_child_play_pretend']) && $details['QuestionNo_75_Does_your_child_play_pretend'] == 'No') ? 'selected' : '' }}>No</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>     Does your child show awareness of other people’s feelings?
                                           
                                        </label>
                                        <select name="QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings" class="nursery-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Yes') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'Yes' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Sometimes') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'Sometimes' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $_GET['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'No') || old('QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings') == 'No' || (isset($details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings']) && $details['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>     Can your child take off some clothes without help?
                                        </label>
                                        <select name="QuestionNo_77_Can_your_child_take_off_some_clothes_without_help" class="nursery-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Yes') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'Yes' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Sometimes') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'Sometimes' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $_GET['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'No') || old('QuestionNo_77_Can_your_child_take_off_some_clothes_without_help') == 'No' || (isset($details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help']) && $details['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>     Is your child starting to show interest in potty training?
                                        </label>
                                        <select name="QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training" class="nursery-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Yes') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'Yes' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Sometimes') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'Sometimes' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $_GET['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'No') || old('QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training') == 'No' || (isset($details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training']) && $details['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Hidden Adaptive score field -->
                                <input type="hidden" name="nursery_Adaptive" id="nursery_Adaptive">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Cognitive_Result" id="nursery_Cognitive_Result" value="{{ $details['nursery_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_cognitive_total_score" id="nursery_cognitive_total_score" value="{{ $details['nursery_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Motor_Result" id="nursery_Motor_Result" value="{{ $details['nursery_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_motor_total_score" id="nursery_motor_total_score" value="{{ $details['nursery_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Language_Result" id="nursery_Language_Result" value="{{ $details['nursery_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_language_total_score" id="nursery_language_total_score" value="{{ $details['nursery_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_SocialEmotional_Result" id="nursery_SocialEmotional_Result" value="{{ $details['nursery_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_social_emotional_total_score" id="nursery_social_emotional_total_score" value="{{ $details['nursery_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_Adaptive_Result" id="nursery_Adaptive_Result" value="{{ $details['nursery_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score (Nursery):</strong></label>
                                        <input type="text" class="form-control" name="nursery_adaptive_total_score" id="nursery_adaptive_total_score" value="{{ $details['nursery_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                               
                            </div>

                        </div>
                        <div id="kindergarten_developmenr" class="d-none">
                            <ul>
                                <li><strong>Age:</strong> 37 – 60 Months</li>
                                <li><strong>Grade:</strong> Kindergarten 1 & 2</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive:</strong> Can your child count to 5 or recognize some colors?
                                        </label>
                                        <select name="QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors" class="kindergarten-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Yes') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'Yes' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Sometimes') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'Sometimes' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $_GET['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'No') || old('QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors') == 'No' || (isset($details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors']) && $details['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Cognitive:</strong>    Can your child follow two-step directions (e.g., “Get your shoes and put them by the
                                            door”)? 
                                        </label>
                                        <select name="QuestionNo_80_Can_your_child_follow_two_step_directions" class="kindergarten-cognitive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Yes') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'Yes' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Sometimes') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'Sometimes' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $_GET['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'No') || old('QuestionNo_80_Can_your_child_follow_two_step_directions') == 'No' || (isset($details['QuestionNo_80_Can_your_child_follow_two_step_directions']) && $details['QuestionNo_80_Can_your_child_follow_two_step_directions'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                
                             
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong> Can your child hop on one foot or catch a large ball?
                                        </label>
                                        <select name="QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball" class="kindergarten-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Yes') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'Yes' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Sometimes') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'Sometimes' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $_GET['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'No') || old('QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball') == 'No' || (isset($details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball']) && $details['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] == 'No') ? 'selected' : '' }}>No</option>                                       
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Motor:</strong>    Can your child use scissors to cut paper? 
                                        </label>
                                        <select name="QuestionNo_82_Can_your_child_use_scissors_to_cut_paper" class="kindergarten-motor">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Yes') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'Yes' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Sometimes') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'Sometimes' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $_GET['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'No') || old('QuestionNo_82_Can_your_child_use_scissors_to_cut_paper') == 'No' || (isset($details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper']) && $details['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <strong>Language:</strong>     <label>Can your child tell a short story or describe an object?</label>
                                        <select name="QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object" class="kindergarten-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Yes') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'Yes' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Sometimes') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'Sometimes' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $_GET['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'No') || old('QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object') == 'No' || (isset($details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object']) && $details['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Language:</strong>   Are you able to understand what your child is saying most of the time?
                                        
                                        </label>
                                        <select name="QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time" class="kindergarten-language">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Yes') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'Yes' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Sometimes') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'Sometimes' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $_GET['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'No') || old('QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time') == 'No' || (isset($details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time']) && $details['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                              
                                
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>    Does your child play cooperatively with other children?
                                        </label>
                                        <select name="QuestionNo_85_Does_your_child_play_cooperatively_with_other_children" class="kindergarten-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Yes') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'Yes' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Sometimes') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'Sometimes' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $_GET['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'No') || old('QuestionNo_85_Does_your_child_play_cooperatively_with_other_children') == 'No' || (isset($details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children']) && $details['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Social-Emotional:</strong>   Does your child express emotions appropriately (e.g., anger, frustration)?
                                           
                                        </label>
                                        <select name="QuestionNo_86_Does_your_child_express_emotions_appropriately" class="kindergarten-social-emotional">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Yes') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'Yes' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Sometimes') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'Sometimes' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $_GET['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'No') || old('QuestionNo_86_Does_your_child_express_emotions_appropriately') == 'No' || (isset($details['QuestionNo_86_Does_your_child_express_emotions_appropriately']) && $details['QuestionNo_86_Does_your_child_express_emotions_appropriately'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>  Can your child dress and undress without help?
                                        </label>
                                        <select name="QuestionNo_87_Can_your_child_dress_and_undress_without_help" class="kindergarten-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Yes') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'Yes' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Sometimes') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'Sometimes' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $_GET['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'No') || old('QuestionNo_87_Can_your_child_dress_and_undress_without_help') == 'No' || (isset($details['QuestionNo_87_Can_your_child_dress_and_undress_without_help']) && $details['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <strong>Adaptive:</strong>   Can your child use the toilet independently?
                                        </label>
                                        <select name="QuestionNo_88_Can_your_child_use_the_toilet_independently" class="kindergarten-adaptive">
                                            <option value="">Select</option>
                                            <option value="Yes" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Yes') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'Yes' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Yes') ? 'selected' : '' }}>Yes</option>
                                            <option value="Sometimes" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Sometimes') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'Sometimes' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'Sometimes') ? 'selected' : '' }}>Sometimes</option>
                                            <option value="No" {{ (isset($_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $_GET['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'No') || old('QuestionNo_88_Can_your_child_use_the_toilet_independently') == 'No' || (isset($details['QuestionNo_88_Can_your_child_use_the_toilet_independently']) && $details['QuestionNo_88_Can_your_child_use_the_toilet_independently'] == 'No') ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                             
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Cognitive_Result" id="kindergarten_Cognitive_Result" value="{{ $details['kindergarten_Cognitive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Cognitive Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_cognitive_total_score" id="kindergarten_cognitive_total_score" value="{{ $details['kindergarten_cognitive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Motor_Result" id="kindergarten_Motor_Result" value="{{ $details['kindergarten_Motor_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Motor Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_motor_total_score" id="kindergarten_motor_total_score" value="{{ $details['kindergarten_motor_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Language_Result" id="kindergarten_Language_Result" value="{{ $details['kindergarten_Language_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Language Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_language_total_score" id="kindergarten_language_total_score" value="{{ $details['kindergarten_language_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_SocialEmotional_Result" id="kindergarten_SocialEmotional_Result" value="{{ $details['kindergarten_SocialEmotional_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Social-Emotional Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_social_emotional_total_score" id="kindergarten_social_emotional_total_score" value="{{ $details['kindergarten_social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Result (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_Adaptive_Result" id="kindergarten_Adaptive_Result" value="{{ $details['kindergarten_Adaptive_Result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Adaptive Total Score (Kindergarten):</strong></label>
                                        <input type="text" class="form-control" name="kindergarten_adaptive_total_score" id="kindergarten_adaptive_total_score" value="{{ $details['kindergarten_adaptive_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="playground_kindergarten_social_emotional" class="d-none">
                        <h4 class="subTitle mt-3">SOCIAL EMOTIONAL BEHAVIORAL SCREENING</h4>
                        <div>
                            <ul>
                                <li><strong>Age:</strong> 24 – 60 Months</li>
                                <li><strong>Grade:</strong> Play Group – KG 2</li>
                            </ul>
                            <p>
                                <strong class="d-block">Instructions:</strong>
                                Read each statement carefully and select the answer that best describes your child’s behavior
                                during the <strong>last 30 days.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Complains of aches or pains (e.g., stomach, head) without clear cause
                                        </label>
                                        <select name="aches_pains" class="aches_pains">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Never' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Never' ? 'selected' : '') : (old('aches_pains') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Sometimes' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Sometimes' ? 'selected' : '') : (old('aches_pains') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['aches_pains']) ? ($_GET['aches_pains'] == 'Often' ? 'selected' : '') : (isset($details['aches_pains']) ? ($details['aches_pains'] == 'Often' ? 'selected' : '') : (old('aches_pains') == 'No' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems sad, unhappy, or cries easily</label>
                                        <select name="sad_unhappy" class="sad_unhappy">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Never' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Never' ? 'selected' : '') : (old('sad_unhappy') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Sometimes' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Sometimes' ? 'selected' : '') : (old('sad_unhappy') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['sad_unhappy']) ? ($_GET['sad_unhappy'] == 'Often' ? 'selected' : '') : (isset($details['sad_unhappy']) ? ($details['sad_unhappy'] == 'Often' ? 'selected' : '') : (old('sad_unhappy') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems irritable or angry more than usual</label>
                                        <select name="irritable_angry" class="irritable_angry">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Never' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Never' ? 'selected' : '') : (old('irritable_angry') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Sometimes' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Sometimes' ? 'selected' : '') : (old('irritable_angry') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['irritable_angry']) ? ($_GET['irritable_angry'] == 'Often' ? 'selected' : '') : (isset($details['irritable_angry']) ? ($details['irritable_angry'] == 'Often' ? 'selected' : '') : (old('irritable_angry') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has trouble sitting still or staying in one place</label>
                                        <select name="trouble_sitting" class="trouble_sitting">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Never' ? 'selected' : '') : (old('trouble_sitting') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sitting') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['trouble_sitting']) ? ($_GET['trouble_sitting'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sitting']) ? ($details['trouble_sitting'] == 'Often' ? 'selected' : '') : (old('trouble_sitting') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Is easily distracted or has trouble focusing on tasks or play</label>
                                        <select name="easily_distracted" class="easily_distracted">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Never' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Never' ? 'selected' : '') : (old('easily_distracted') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Sometimes' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Sometimes' ? 'selected' : '') : (old('easily_distracted') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['easily_distracted']) ? ($_GET['easily_distracted'] == 'Often' ? 'selected' : '') : (isset($details['easily_distracted']) ? ($details['easily_distracted'] == 'Often' ? 'selected' : '') : (old('easily_distracted') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Doesn’t listen when spoken to directly</label>
                                        <select name="doesnt_listen" class="doesnt_listen">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Never' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Never' ? 'selected' : '') : (old('doesnt_listen') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Sometimes' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Sometimes' ? 'selected' : '') : (old('doesnt_listen') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['doesnt_listen']) ? ($_GET['doesnt_listen'] == 'Often' ? 'selected' : '') : (isset($details['doesnt_listen']) ? ($details['doesnt_listen'] == 'Often' ? 'selected' : '') : (old('doesnt_listen') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Fidgets with hands or feet or squirms in seat</label>
                                        <select name="fidgets" class="fidgets">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Never' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Never' ? 'selected' : '') : (old('fidgets') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Sometimes' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Sometimes' ? 'selected' : '') : (old('fidgets') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['fidgets']) ? ($_GET['fidgets'] == 'Often' ? 'selected' : '') : (isset($details['fidgets']) ? ($details['fidgets'] == 'Often' ? 'selected' : '') : (old('fidgets') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Acts as if “driven by a motor” or always “on the go”</label>
                                        <select name="driven_motor" class="driven_motor">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Never' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Never' ? 'selected' : '') : (old('driven_motor') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Sometimes' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Sometimes' ? 'selected' : '') : (old('driven_motor') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['driven_motor']) ? ($_GET['driven_motor'] == 'Often' ? 'selected' : '') : (isset($details['driven_motor']) ? ($details['driven_motor'] == 'Often' ? 'selected' : '') : (old('driven_motor') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Argues or talks back when told to do something</label>
                                        <select name="argues_talks_back" class="argues_talks_back">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Never' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Never' ? 'selected' : '') : (old('argues_talks_back') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Sometimes' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Sometimes' ? 'selected' : '') : (old('argues_talks_back') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['argues_talks_back']) ? ($_GET['argues_talks_back'] == 'Often' ? 'selected' : '') : (isset($details['argues_talks_back']) ? ($details['argues_talks_back'] == 'Often' ? 'selected' : '') : (old('argues_talks_back') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has difficulty waiting for their turn</label>
                                        <select name="difficulty_waiting" class="difficulty_waiting">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Never' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Never' ? 'selected' : '') : (old('difficulty_waiting') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Sometimes' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Sometimes' ? 'selected' : '') : (old('difficulty_waiting') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['difficulty_waiting']) ? ($_GET['difficulty_waiting'] == 'Often' ? 'selected' : '') : (isset($details['difficulty_waiting']) ? ($details['difficulty_waiting'] == 'Often' ? 'selected' : '') : (old('difficulty_waiting') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Blames others for their mistakes</label>
                                        <select name="blames_others" class="blames_others">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Never' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Never' ? 'selected' : '') : (old('blames_others') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Sometimes' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Sometimes' ? 'selected' : '') : (old('blames_others') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['blames_others']) ? ($_GET['blames_others'] == 'Often' ? 'selected' : '') : (isset($details['blames_others']) ? ($details['blames_others'] == 'Often' ? 'selected' : '') : (old('blames_others') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Hits, kicks, or bites others when upset</label>
                                        <select name="hits_kicks_bites" class="hits_kicks_bites">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Never' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Never' ? 'selected' : '') : (old('hits_kicks_bites') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Sometimes' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Sometimes' ? 'selected' : '') : (old('hits_kicks_bites') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['hits_kicks_bites']) ? ($_GET['hits_kicks_bites'] == 'Often' ? 'selected' : '') : (isset($details['hits_kicks_bites']) ? ($details['hits_kicks_bites'] == 'Often' ? 'selected' : '') : (old('hits_kicks_bites') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Seems anxious or worries a lot</label>
                                        <select name="anxious_worries" class="anxious_worries">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Never' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Never' ? 'selected' : '') : (old('anxious_worries') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Sometimes' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Sometimes' ? 'selected' : '') : (old('anxious_worries') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['anxious_worries']) ? ($_GET['anxious_worries'] == 'Often' ? 'selected' : '') : (isset($details['anxious_worries']) ? ($details['anxious_worries'] == 'Often' ? 'selected' : '') : (old('anxious_worries') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Is afraid to try new things or explore surroundings</label>
                                        <select name="afraid_new_things" class="afraid_new_things">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Never' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Never' ? 'selected' : '') : (old('afraid_new_things') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Sometimes' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Sometimes' ? 'selected' : '') : (old('afraid_new_things') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['afraid_new_things']) ? ($_GET['afraid_new_things'] == 'Often' ? 'selected' : '') : (isset($details['afraid_new_things']) ? ($details['afraid_new_things'] == 'Often' ? 'selected' : '') : (old('afraid_new_things') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Refuses to separate from parents or caregivers (e.g., at school/daycare)</label>
                                        <select name="refuses_separate" class="refuses_separate">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Never' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Never' ? 'selected' : '') : (old('refuses_separate') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Sometimes' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Sometimes' ? 'selected' : '') : (old('refuses_separate') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['refuses_separate']) ? ($_GET['refuses_separate'] == 'Often' ? 'selected' : '') : (isset($details['refuses_separate']) ? ($details['refuses_separate'] == 'Often' ? 'selected' : '') : (old('refuses_separate') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Has nightmares or trouble sleeping</label>
                                        <select name="nightmares_sleeping" class="nightmares_sleeping">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Never' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Never' ? 'selected' : '') : (old('nightmares_sleeping') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Sometimes' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Sometimes' ? 'selected' : '') : (old('nightmares_sleeping') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['nightmares_sleeping']) ? ($_GET['nightmares_sleeping'] == 'Often' ? 'selected' : '') : (isset($details['nightmares_sleeping']) ? ($details['nightmares_sleeping'] == 'Often' ? 'selected' : '') : (old('nightmares_sleeping') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Loses temper easily or has frequent tantrums</label>
                                        <select name="loses_temper" class="loses_temper">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Never' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Never' ? 'selected' : '') : (old('loses_temper') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Sometimes' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Sometimes' ? 'selected' : '') : (old('loses_temper') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['loses_temper']) ? ($_GET['loses_temper'] == 'Often' ? 'selected' : '') : (isset($details['loses_temper']) ? ($details['loses_temper'] == 'Often' ? 'selected' : '') : (old('loses_temper') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Internalizing Score</label>
                                     <input type="text" name="social_emotional_result" class="form-control" value="{{ $details['social_emotional_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Attention Score</label>
                                     <input type="text" name="social_emotional_Attention_result" class="form-control" value="{{ $details['social_emotional_Attention_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Externalizing Total Score:</strong></label>
                                        <input type="text" class="form-control" name="externalizing_socialtotal_emotional_score" id="externalizing_socialtotal_emotional_score" value="{{ $details['externalizing_social_emotional_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Externalizing Score </label>
                                     <input type="text" name="externalizing_social_emotional_score" class="form-control" value="{{ $details['externalizing_social_emotional_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Attention Total Score:</strong></label>
                                        <input type="text" class="form-control" name="social_emotional_attention_total_score" id="social_emotional_attention_total_score" value="{{ $details['social_emotional_attention_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Internalizing Total Score:</strong></label>
                                        <input type="text" class="form-control" name="social_emotional_total_score" id="social_emotional_total_score" value="{{ $details['social_emotional_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Social and Emotional Behavior  </label>
                                     <textarea name="social_emotional_behavior" id="social_emotional_behavior" cols="30" rows="10">{{ isset($_GET['social_emotional_behavior']) ? $_GET['social_emotional_behavior'] : (isset($details['social_emotional_behavior']) ? $details['social_emotional_behavior'] : old('social_emotional_behavior')) }}</textarea>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div id="playground_kindergarten_autism_spectrum" class="d-none">
                        <h4 class="subTitle mt-3">AUTISM SPECTRUM DISORDER SCREENING</h4>
                        <div>
                            <ul>
                                <li><strong>Age:</strong> 24 – 60 Months</li>
                                <li><strong>Grade:</strong> Play Group – KG 2</li>
                            </ul>
                            <p>
                                Please answer the following questions about your child’s typical behavior over the <strong>past
                                    3 months.</strong>
                            </p>
                            <div class="row screener-fields">
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child make eye contact when talking or playing?
                                        </label>
                                        <select name="eye_contact" class="eye_contact">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Never' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Never' ? 'selected' : '') : (old('eye_contact') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Sometimes' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Sometimes' ? 'selected' : '') : (old('eye_contact') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['eye_contact']) ? ($_GET['eye_contact'] == 'Often' ? 'selected' : '') : (isset($details['eye_contact']) ? ($details['eye_contact'] == 'Often' ? 'selected' : '') : (old('eye_contact') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child show feelings like happiness, sadness, or anger in ways you
                                            understand?
                                        </label>
                                        <select name="show_feelings" class="show_feelings">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Never' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Never' ? 'selected' : '') : (old('show_feelings') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Sometimes' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Sometimes' ? 'selected' : '') : (old('show_feelings') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['show_feelings']) ? ($_GET['show_feelings'] == 'Often' ? 'selected' : '') : (isset($details['show_feelings']) ? ($details['show_feelings'] == 'Often' ? 'selected' : '') : (old('show_feelings') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use gestures like pointing, waving, or nodding to communicate?
                                        </label>
                                        <select name="use_gestures" class="use_gestures">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Never' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Never' ? 'selected' : '') : (old('use_gestures') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Sometimes' ? 'selected' : '') : (old('use_gestures') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_gestures']) ? ($_GET['use_gestures'] == 'Often' ? 'selected' : '') : (isset($details['use_gestures']) ? ($details['use_gestures'] == 'Often' ? 'selected' : '') : (old('use_gestures') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <!-- How does your child react to changes in routine or new situations? -->
                                              Does your child gets upset to changes in routine or new situations?
                                        </label>
                                        <select name="react_to_changes" class="react_to_changes">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Never' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Never' ? 'selected' : '') : (old('react_to_changes') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Sometimes' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Sometimes' ? 'selected' : '') : (old('react_to_changes') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['react_to_changes']) ? ($_GET['react_to_changes'] == 'Often' ? 'selected' : '') : (isset($details['react_to_changes']) ? ($details['react_to_changes'] == 'Often' ? 'selected' : '') : (old('react_to_changes') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Does your child respond when someone calls their name or speaks to them?</label>
                                        <select name="respond_to_name" class="respond_to_name">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Never' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Never' ? 'selected' : '') : (old('respond_to_name') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Sometimes' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Sometimes' ? 'selected' : '') : (old('respond_to_name') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['respond_to_name']) ? ($_GET['respond_to_name'] == 'Often' ? 'selected' : '') : (isset($details['respond_to_name']) ? ($details['respond_to_name'] == 'Often' ? 'selected' : '') : (old('respond_to_name') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use words or sentences to express needs or feelings?
                                        </label>
                                        <select name="use_words" class="use_words">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Never' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Never' ? 'selected' : '') : (old('use_words') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Sometimes' ? 'selected' : '') : (old('use_words') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_words']) ? ($_GET['use_words'] == 'Often' ? 'selected' : '') : (isset($details['use_words']) ? ($details['use_words'] == 'Often' ? 'selected' : '') : (old('use_words') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child use facial expressions (smiling, frowning) to communicate?
                                        </label>
                                        <select name="use_facial_expressions" class="use_facial_expressions">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Never' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Never' ? 'selected' : '') : (old('use_facial_expressions') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Sometimes' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Sometimes' ? 'selected' : '') : (old('use_facial_expressions') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['use_facial_expressions']) ? ($_GET['use_facial_expressions'] == 'Often' ? 'selected' : '') : (isset($details['use_facial_expressions']) ? ($details['use_facial_expressions'] == 'Often' ? 'selected' : '') : (old('use_facial_expressions') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            <!-- Is your child’s activity level appropriate (not too high or low) compared to other
                                            children? -->
                                             Does your child seem more restless or less active than other children?
                                        </label>
                                        <select name="appropriate_activity_level" class="appropriate_activity_level">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Never' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Never' ? 'selected' : '') : (old('appropriate_activity_level') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Sometimes' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Sometimes' ? 'selected' : '') : (old('appropriate_activity_level') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['appropriate_activity_level']) ? ($_GET['appropriate_activity_level'] == 'Often' ? 'selected' : '') : (isset($details['appropriate_activity_level']) ? ($details['appropriate_activity_level'] == 'Often' ? 'selected' : '') : (old('appropriate_activity_level') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Can your child follow simple directions (e.g., “Bring me the toy”)?
                                        </label>
                                        <select name="follow_directions" class="follow_directions">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Never' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Never' ? 'selected' : '') : (old('follow_directions') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Sometimes' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Sometimes' ? 'selected' : '') : (old('follow_directions') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['follow_directions']) ? ($_GET['follow_directions'] == 'Often' ? 'selected' : '') : (isset($details['follow_directions']) ? ($details['follow_directions'] == 'Often' ? 'selected' : '') : (old('follow_directions') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>
                                            Does your child play with other children or engage in group activities?
                                        </label>
                                        <select name="play_with_others" class="play_with_others">
                                            <option value="">Select</option>
                                            <option value="Never" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Never' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Never' ? 'selected' : '') : (old('play_with_others') == 'Never' ? 'selected' : '')) }}>Never</option>
                                            <option value="Sometimes" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Sometimes' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Sometimes' ? 'selected' : '') : (old('play_with_others') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                            <option value="Often" {{ isset($_GET['play_with_others']) ? ($_GET['play_with_others'] == 'Often' ? 'selected' : '') : (isset($details['play_with_others']) ? ($details['play_with_others'] == 'Often' ? 'selected' : '') : (old('play_with_others') == 'Often' ? 'selected' : '')) }}>Often</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>Autism Spectrum Score</label>
                                        <input type="text" name="autism_spectrum_result" class="form-control" value="{{ $details['autism_spectrum_result'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label><strong>Autism Spectrum Total Score:</strong></label>
                                        <input type="text" class="form-control" name="autism_spectrum_total_score" id="autism_spectrum_total_score" value="{{ $details['autism_spectrum_total_score'] ?? '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="screener-field">
                                        <label>AUTISM SPECTRUM  </label>
                                     <textarea name="autism_spectrum_Comment" id="autism_spectrum_Comment" cols="30" rows="10">{{ isset($_GET['autism_spectrum_Comment']) ? $_GET['autism_spectrum_Comment'] : (isset($details['autism_spectrum_Comment']) ? $details['autism_spectrum_Comment'] : old('autism_spectrum_Comment')) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="screener" id="primary_secondary" class="d-none">
                    <h3 class="title">PRIMARY/SECONDARY PSYCHOLOGICAL SCREENER</h3>
                    <div id="primary_secondary_inner">
                        <ul>
                            <li><strong>Age:</strong> 6-16 years</li>
                            <li><strong>Grade:</strong> 1-10</li>
                        </ul>
                        <p>
                            <strong class="d-block">Instructions:</strong>
                            Ask the child: "In the past few weeks, how often have these things been true for you?"
                            <br>
                            Ask each question in a child-friendly, age-appropriate way. Mark the response as reported by the
                            child.
                        </p>
                        <div class="row screener-fields">
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You feel sad, unhappy, or like crying.
                                    </label>
                                    <select name="feel_sad" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Never' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Never' ? 'selected' : '') : (old('feel_sad') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Sometimes' ? 'selected' : '') : (old('feel_sad') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_sad']) ? ($_GET['feel_sad'] == 'Often' ? 'selected' : '') : (isset($details['feel_sad']) ? ($details['feel_sad'] == 'Often' ? 'selected' : '') : (old('feel_sad') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You are easily distracted or have trouble concentrating.
                                    </label>
                                    <select name="easily_distracted_primary" class="attention-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Never' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Never' ? 'selected' : '') : (old('easily_distracted_primary') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Sometimes' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Sometimes' ? 'selected' : '') : (old('easily_distracted_primary') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['easily_distracted_primary']) ? ($_GET['easily_distracted_primary'] == 'Often' ? 'selected' : '') : (isset($details['easily_distracted_primary']) ? ($details['easily_distracted_primary'] == 'Often' ? 'selected' : '') : (old('easily_distracted_primary') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You feel nervous, worried, or afraid a lot.
                                    </label>
                                    <select name="feel_nervous" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Never' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Never' ? 'selected' : '') : (old('feel_nervous') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Sometimes' ? 'selected' : '') : (old('feel_nervous') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_nervous']) ? ($_GET['feel_nervous'] == 'Often' ? 'selected' : '') : (isset($details['feel_nervous']) ? ($details['feel_nervous'] == 'Often' ? 'selected' : '') : (old('feel_nervous') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You have trouble sleeping or feel tired most of the time.
                                    </label>
                                    <select name="trouble_sleeping" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Never' ? 'selected' : '') : (old('trouble_sleeping') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sleeping') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['trouble_sleeping']) ? ($_GET['trouble_sleeping'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sleeping']) ? ($details['trouble_sleeping'] == 'Often' ? 'selected' : '') : (old('trouble_sleeping') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>You feel lonely or like being alone more than usual.</label>
                                    <select name="feel_lonely" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Never' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Never' ? 'selected' : '') : (old('feel_lonely') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Sometimes' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Sometimes' ? 'selected' : '') : (old('feel_lonely') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['feel_lonely']) ? ($_GET['feel_lonely'] == 'Often' ? 'selected' : '') : (isset($details['feel_lonely']) ? ($details['feel_lonely'] == 'Often' ? 'selected' : '') : (old('feel_lonely') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You often argue or talk back when told to do something.
                                    </label>
                                    <select name="argue_talk_back" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Never' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Never' ? 'selected' : '') : (old('argue_talk_back') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Sometimes' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Sometimes' ? 'selected' : '') : (old('argue_talk_back') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['argue_talk_back']) ? ($_GET['argue_talk_back'] == 'Often' ? 'selected' : '') : (isset($details['argue_talk_back']) ? ($details['argue_talk_back'] == 'Often' ? 'selected' : '') : (old('argue_talk_back') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You take things that do not belong to you or refuse to share.
                                    </label>
                                    <select name="take_things_refuse_share" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Never' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Never' ? 'selected' : '') : (old('take_things_refuse_share') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Sometimes' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Sometimes' ? 'selected' : '') : (old('take_things_refuse_share') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['take_things_refuse_share']) ? ($_GET['take_things_refuse_share'] == 'Often' ? 'selected' : '') : (isset($details['take_things_refuse_share']) ? ($details['take_things_refuse_share'] == 'Often' ? 'selected' : '') : (old('take_things_refuse_share') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You fight with other children or get angry quickly.
                                    </label>
                                    <select name="fight_angry_quickly" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Never' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Never' ? 'selected' : '') : (old('fight_angry_quickly') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Sometimes' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Sometimes' ? 'selected' : '') : (old('fight_angry_quickly') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['fight_angry_quickly']) ? ($_GET['fight_angry_quickly'] == 'Often' ? 'selected' : '') : (isset($details['fight_angry_quickly']) ? ($details['fight_angry_quickly'] == 'Often' ? 'selected' : '') : (old('fight_angry_quickly') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You don’t enjoy things you used to enjoy.
                                    </label>
                                    <select name="dont_enjoy_things" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Never' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Never' ? 'selected' : '') : (old('dont_enjoy_things') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Sometimes' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Sometimes' ? 'selected' : '') : (old('dont_enjoy_things') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['dont_enjoy_things']) ? ($_GET['dont_enjoy_things'] == 'Often' ? 'selected' : '') : (isset($details['dont_enjoy_things']) ? ($details['dont_enjoy_things'] == 'Often' ? 'selected' : '') : (old('dont_enjoy_things') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You are clingy or need to be with adults all the time.
                                    </label>
                                    <select name="clingy_need_adults" class="emotional-behavior">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Never' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Never' ? 'selected' : '') : (old('clingy_need_adults') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Sometimes' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Sometimes' ? 'selected' : '') : (old('clingy_need_adults') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['clingy_need_adults']) ? ($_GET['clingy_need_adults'] == 'Often' ? 'selected' : '') : (isset($details['clingy_need_adults']) ? ($details['clingy_need_adults'] == 'Often' ? 'selected' : '') : (old('clingy_need_adults') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You have trouble sitting still or feel “on the go” a lot.
                                    </label>
                                    <select name="trouble_sitting_still" class="attention-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Never' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Never' ? 'selected' : '') : (old('trouble_sitting_still') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Sometimes' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Sometimes' ? 'selected' : '') : (old('trouble_sitting_still') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['trouble_sitting_still']) ? ($_GET['trouble_sitting_still'] == 'Often' ? 'selected' : '') : (isset($details['trouble_sitting_still']) ? ($details['trouble_sitting_still'] == 'Often' ? 'selected' : '') : (old('trouble_sitting_still') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>
                                        You don’t listen to rules or directions.
                                    </label>
                                    <select name="dont_listen_rules" class="behavioral-issues">
                                        <option value="">Select</option>
                                        <option value="Never" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Never' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Never' ? 'selected' : '') : (old('dont_listen_rules') == 'Never' ? 'selected' : '')) }}>Never</option>
                                        <option value="Sometimes" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Sometimes' ? 'selected' : '') : (old('dont_listen_rules') == 'Sometimes' ? 'selected' : '')) }}>Sometimes</option>
                                        <option value="Often" {{ isset($_GET['dont_listen_rules']) ? ($_GET['dont_listen_rules'] == 'Often' ? 'selected' : '') : (isset($details['dont_listen_rules']) ? ($details['dont_listen_rules'] == 'Often' ? 'selected' : '') : (old('dont_listen_rules') == 'Often' ? 'selected' : '')) }}>Often</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Internalizating Result</label>
                                    <input type="text" name="emotional_behavior_result" class="form-control" value="{{ $details['emotional_behavior_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Internalizating Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_internalization_total_score" id="psychological_internalization_total_score" value="{{ $details['psychological_internalization_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Externalizating Result</label>
                                    <input type="text" name="behavioral_issues_result" class="form-control" value="{{ $details['behavioral_issues_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Externalizating Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_externalization_total_score" id="psychological_externalization_total_score" value="{{ $details['psychological_externalization_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label>Attention  Result</label>
                                    <input type="text" name="attention_issues_result" class="form-control" value="{{ $details['attention_issues_result'] ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="screener-field">
                                    <label><strong>Attention Total Score:</strong></label>
                                    <input type="text" class="form-control" name="psychological_attention_total_score" id="psychological_attention_total_score" value="{{ $details['psychological_attention_total_score'] ?? '' }}" readonly>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="psychological_comment"><b>Psychological Assessment Comments:</b></label><br>
                            <textarea name="psychological_comment" id="psychological_comment" placeholder="Comments will be auto-generated based on assessment scores" cols="50" rows="5" readonly>{{ isset($_GET['psychological_comment']) ? $_GET['psychological_comment'] : (isset($details['psychological_comment']) ? $details['psychological_comment'] : old('psychological_comment')) }}</textarea>
                        </div>
                    </div>
                </div>


                <button type="button" class="btn btn-primary prevStep">Previous</button>
                <button type="button" class="btn btn-primary nextStep">Next</button>
            </div>