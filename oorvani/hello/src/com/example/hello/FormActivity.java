package com.example.hello;

import java.util.ArrayList;
import java.util.HashMap;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.AsyncTask;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

public class FormActivity extends Activity{

	ArrayList<String> name, link;
	ListView surveyList;
	SharedPreferences prefs;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.forms);
		 prefs = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
		 Toast.makeText(getApplicationContext(), "Welcome, "+prefs.getString("name", "")+"!" , Toast.LENGTH_LONG).show();
		 
//	    String status	 = prefs.getString("auth", "");
		surveyList = (ListView)findViewById(R.id.surveyList);
		
		 String[] values = new String[] { "Android List View", 
                 "Adapter implementation",
                 "Simple List View In Android",
                 "Create List View Android", 
                 "Android Example", 
                 "List View Source Code", 
                 "List View Array Adapter", 
                 "Android Example List View" 
                };
		 surveyList.setOnItemClickListener(new OnItemClickListener(){
        	 
			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				// TODO Auto-generated method stub
				Intent i = new Intent(FormActivity.this,FormViewActivity.class);
//				startActivity(i);
				
			}
          });
		 ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1, android.R.id.text1, values);
	    	    
	            // Assign adapter to ListView
//	     surveyList.setAdapter(adapter); 
		 GPSTracker gps = new GPSTracker(FormActivity.this);
		 
         // check if GPS enabled     
         if(gps.canGetLocation()){
              
             double latitude = gps.getLatitude();
             double longitude = gps.getLongitude();
              
             // \n is for new line
//             Toast.makeText(getApplicationContext(), "Your Location is - \nLat: " + latitude + "\nLong: " + longitude, Toast.LENGTH_LONG).show();    
             Editor editor = prefs.edit();
				editor.putString("lat",String.valueOf(latitude));
				editor.putString("lon",String.valueOf(longitude));
				editor.commit();
         }else{
             // can't get location
             // GPS or Network is not enabled
             // Ask user to enable GPS/network in settings
             gps.showSettingsAlert();
         }
		 
		 
		 GetSurveys task = new GetSurveys();
		task.execute();  
		
		
	}
	
	private class GetSurveys extends AsyncTask<String, Void, Boolean>{
		
		JSONArray array;
		JSONObject obj;
		String response, item_name, item_link;
		ArrayList<HashMap<String, Object>> map_newlist;
		@Override
		protected Boolean doInBackground(String... arg0) {
			// TODO Auto-generated method stub
			try{
				HttpClient client = new DefaultHttpClient();  
//				String folder = getString(R.string.server_addr);
				String uri = "http://"+getString(R.string.server_global)+"/hack/forms.php";
				Log.d("URI", uri);
				HttpGet get = new HttpGet(uri);
				
		        HttpResponse responseGet = client.execute(get);  
		        HttpEntity resEntity = responseGet.getEntity();
		        if (resEntity != null) 
		        {  
		                 	response = EntityUtils.toString(resEntity);
		                    Log.d("response", response);
		        }
				array = new JSONArray(response);
				int arrlen = array.length();
				Log.d("Array Length", Integer.toString(arrlen));
				map_newlist = new ArrayList<HashMap<String,Object>>();
				HashMap<String,Object> tmp_newmap;
//				request_id, name, action,quant, id;
				name = new ArrayList<String>();
				link = new ArrayList<String>();
				for(int i=0;i<arrlen;i++)
				{
					
					obj = array.getJSONObject(i);
					item_name = obj.getString("name");
					item_link = obj.getString("link");
					
					tmp_newmap = new HashMap<String,Object>();
					tmp_newmap.put("name", item_name);
					tmp_newmap.put("link", item_link);
//					id.add(item_id);
					name.add(item_name);
//					action.add(item_action);
//					quant.add(item_quant);
					link.add(item_link);
//					tmp_newmap.put("chamber", item_action);
//					if(item_action.equals("Update")){
//						tmp_newmap.put("image",android.R.drawable.ic_menu_add);
//					}else{
//						tmp_newmap.put("image",android.R.drawable.ic_menu_delete);
//					}
					map_newlist.add(tmp_newmap);
//					Toast.makeText(LoginActivity.this, tmp_fname, Toast.LENGTH_LONG).show();
					
				}
				return true;
			}catch(Exception e){
				Log.d("Error", e.getMessage());
			}
			return null;
		}

		@Override
		protected void onPostExecute(Boolean result) {
			// TODO Auto-generated method stub
			super.onPostExecute(result);
			Log.d("RESULT", String.valueOf(result));
			String[] lv_arr = {};
//			lv_arr = (String[]) name.toArray();
			surveyList.setAdapter(new ArrayAdapter<String>(FormActivity.this,
		            android.R.layout.simple_list_item_1,name ));
//			map_newadapter = new SimpleAdapter(this,map_newlist,R.layout.update_list_row,
//		    		new String[]{"name","chamber","image"}, 
//		    		new int[]{R.id.spName,R.id.spDesc,R.id.imageViewFac}) ;
//			lv.setAdapter(map_newadapter);
			surveyList.setOnItemClickListener(new OnItemClickListener(){
	        	 
				@Override
				public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
						long arg3) {
					// TODO Auto-generated method stub
//					Toast.makeText(getActivity(), id.get(arg2), Toast.LENGTH_LONG).show();
					Editor editor = prefs.edit();
					String uri = link.get(arg2);
					Log.d("URL", uri);
					editor.putString("link",uri);
					editor.commit();
					Intent i = new Intent(FormActivity.this,FormViewActivity.class);
					startActivity(i);
				}
	          });
		}
		
	}

}