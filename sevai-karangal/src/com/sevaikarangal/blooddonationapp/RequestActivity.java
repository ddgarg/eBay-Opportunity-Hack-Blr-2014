package com.sevaikarangal.blooddonationapp;

import java.util.ArrayList;
import java.util.List;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;


class RequestInfo {
	
		public  String bloodtype ;
		public  String units ;
		public  String pname ;
		public  String hospital  ;
		public  String contactp ;
		public  String contactno ;
		public  String date ;
		public  String city ;
		public  String location ;
		
		
		public RequestInfo(String bloodtype, String units,String pname
				,String hospital ,String contactp,String contactno,String location
				, String date,String city )
		{
		
			this.bloodtype = bloodtype;
			this.units = units;
			this.pname = pname;
			this.hospital = hospital;
			this.contactp = contactp;
			this.contactno = contactno;
			this.date = date;
			this.city = city;
			this.location = location;
		}
		
		public void printobj()
		{
			System.out.println(this.bloodtype);
			System.out.println(this.units);
			System.out.println(this.hospital);
			System.out.println(this.location);
		}
}

public class RequestActivity extends Activity {

	
	Spinner spinner; 
	String spinnerout  = "";
	String[] bloudgroups = {"A+","B+","A","O","O+"};
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_request);
		
		addItemsOnSpinner2();
		
		Button submit=(Button)findViewById(R.id.button1);
        submit.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
								
				EditText mEdit1   = (EditText)findViewById(R.id.units);
				EditText mEdit2   = (EditText)findViewById(R.id.patientn);
				EditText mEdit3   = (EditText)findViewById(R.id.hospital);
				EditText mEdit4   = (EditText)findViewById(R.id.contactp);
				EditText mEdit5   = (EditText)findViewById(R.id.contactn);
				EditText mEdit6   = (EditText)findViewById(R.id.location);
				EditText mEdit7   = (EditText)findViewById(R.id.date);
				EditText mEdit8   = (EditText)findViewById(R.id.city);
				
RequestInfo rq = 
new RequestInfo(spinner.getSelectedItem().toString(),mEdit1.getText().toString()
		,mEdit2.getText().toString(),mEdit3.getText().toString()
		,mEdit4.getText().toString(),mEdit5.getText().toString(),mEdit6.getText().toString(),
		mEdit7.getText().toString(),mEdit8.getText().toString());
				

// SEND teh request object to the server and call the API 

			Intent reqobj = new Intent(RequestActivity.this, RequestActivity2.class);
			startActivity(reqobj);


				/*Intent intent1 = new Intent(LocationUpdateDemoActivity.this,HttpPostDemo.class);
				intent1.putExtra(name, str);
				intent1.putExtra(loc, loc);
				
				startActivity(intent1);
				
				*/
				/*try
				{
				Intent intent2 = new Intent(Intent.ACTION_CALL,Uri.parse("tel:100"));
				startActivity(intent2);
				}
				catch(ActivityNotFoundException activityException)
				{
					Log.v("err", "call failed ",activityException);
				}*/
				
				/*
				 
				SmsManager smsmgr = SmsManager.getDefault();
				smsmgr.sendTextMessage(destinationAddress, scAddress, text, null, null);
				*/
			
//remove later 
				
Toast.makeText(getApplicationContext(), (String)spinner.getSelectedItem().toString(), 
		   Toast.LENGTH_LONG).show();

Toast.makeText(getApplicationContext(), (String)mEdit1.getText().toString(), 
		   Toast.LENGTH_LONG).show();


			}				
		});
	    
        
        Button emerb=(Button)findViewById(R.id.button2);
        emerb.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
		
				Intent emer = new  Intent(RequestActivity.this, EmergencyCase.class);
				startActivity(emer);
				
				// in teh above activity get the location etc
				
			}				
			});
		    
        
        	
        
        
	}

	public void addItemsOnSpinner2() {
		 
		spinner = (Spinner) findViewById(R.id.spinner1);
		List<String> list = new ArrayList<String>();
		list.add("O+ve");
		list.add("O-ve");
		list.add("A-ve");
		list.add("B-ve");
		list.add("B+ve");
		ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this,
			android.R.layout.simple_spinner_item, list);
		dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
		spinner.setAdapter(dataAdapter);
		
	  }
	
	
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.request, menu);
		return true;
	}

}
