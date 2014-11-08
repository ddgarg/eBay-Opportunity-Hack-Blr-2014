package com.sevaikarangal.blooddonationapp;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;

public class EmergencyCase   extends Activity  {

	LocationManager locMgr = null;
	LocationListener locListener = null;
	
	public static Double lat,lon;
	
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.emergency);
        
        locMgr = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        locMgr.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, new geoUpdate());
        Location lc = locMgr.getLastKnownLocation(LocationManager.GPS_PROVIDER);
        
        
    }
    
    public void openRequestActivity(View view) {
    	Intent intent = new Intent(this, RequestActivity.class);
    	startActivity(intent);
    }

    public void openDonateActivity(View view) {
    	Intent intent = new Intent(this, SubscribeActivity.class);
    	startActivity(intent);
    }
    
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }
    
    
	
}



 class geoUpdate implements LocationListener
{

	
	@Override
	public void onLocationChanged(Location location) {
		// TODO Auto-generated method stub
		
		Double d_lat = location.getLongitude();
        String str6 = d_lat.toString();
        Double d_lon = location.getLongitude();
        String str7 = d_lon.toString();
        
        
        
        String dbtime;
        String dbUrl = "jdbc:mysql://10.0.2.2:3306/hi";
        String dbClass = "com.mysql.jdbc.Driver";
        String query = "Select * FROM gdg";
        
       
        
        try {
        	 
        	Class.forName(dbClass);
        	Connection con = DriverManager.getConnection (dbUrl,"root","");
        	Log.v("234", "conn");
        	//Toast.makeText(getBaseContext(), "hufh", Toast.LENGTH_LONG).show();
        	Statement stmt = con.createStatement();
        	ResultSet rs = stmt.executeQuery(query);
        	
        	Statement s = con.createStatement();
        	s.executeUpdate("INSERT INTO gdg " + "VALUES (744, 346, 33)");
        	//Toast.makeText(getBaseContext(), str6, Toast.LENGTH_LONG).show();
        	
        	while (rs.next()) {
        	dbtime = rs.getString(3);
        	System.out.println(dbtime);
        	} //end while

        	con.close();
        	} //end try

        	catch(ClassNotFoundException e) {
        	e.printStackTrace();
        	//Toast.makeText(getBaseContext(), "sdfsd", Toast.LENGTH_LONG).show();
        	//Log.v("sdf", e.getMessage());
        	}

        	catch(SQLException e) {
        	e.printStackTrace();
        	//Toast.makeText(getBaseContext(), "s456dfsd", Toast.LENGTH_LONG).show();
        	//Log.v("sdf", e.getMessage());
        	}
	}

	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub
	
		
		
	}
	
}

