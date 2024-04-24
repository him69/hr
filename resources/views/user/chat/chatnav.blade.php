@if($chat_group->count() > 0)
    			@foreach($chat_group as $group)
        			@if()
        			    <div class="flex items-center pr-10 my-3 pt-2">
        					<img src="https://i.imgur.com/IAgGUYF.jpg" class="rounded-full shadow-xl" width="20" height="20" style="margin-top: 10px;align-self: baseline;">
        					<div style="margin: 0 12px;">
                                <div style="font-size: 10px;width: fit-content;background: aliceblue;padding: 3px;border-radius: 5px;margin: 10px 0px;">
                                   Alex cario, 11:00 am
                                </div>
                                <div style="background: aliceblue;padding: 5px;border-radius: 5px;">
                                    hello whats up what are you doing
                                </div>
                            </div>
        			    </div>
                    @else
        				<div class="flex justify-end pt-2 pl-10">
        					<div style="margin: 0 12px;">
        					    <div style="background: aliceblue;padding: 5px;border-radius: 5px;">
                                    hello
                                    <div style="font-size: 10px;text-align: end;">
                                   11:00 am
                                </div>
                                </div>
                            </div>
        				</div>
        			@endif
    			@endforeach
    			@endif