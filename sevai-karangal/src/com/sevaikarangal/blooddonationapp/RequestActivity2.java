package com.sevaikarangal.blooddonationapp;

import android.app.Activity;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class RequestActivity2 extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_request2);
		
		
		Button dondorl=(Button)findViewById(R.id.donorlist);
		dondorl.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				//Toast.makeText(getApplicationContext(), (String), 
					//	   Toast.LENGTH_LONG).show();
				
				

							}				
						});
        
        
        Button sms=(Button)findViewById(R.id.donorlist);
        sms.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				Toast.makeText(getApplicationContext(), "We are now going to send SMS to top 5 matched contacts ",
						Toast.LENGTH_LONG).show();
				
				String smsBody = "";String phoneNumber = "";
				
				try {
					// Get the default instance of the SmsManager
					SmsManager smsManager = SmsManager.getDefault();
					smsManager.sendTextMessage(phoneNumber, 
							null,  
							smsBody, 
							null, 
							null);
					Toast.makeText(getApplicationContext(), "Your sms has successfully sent!",
							Toast.LENGTH_LONG).show();
				} catch (Exception ex) {
					Toast.makeText(getApplicationContext(),"Your sms has failed...",
							Toast.LENGTH_LONG).show();
					ex.printStackTrace();
				}
				
				

							}				
						});
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.subscribe, menu);
		return true;
	}

}
