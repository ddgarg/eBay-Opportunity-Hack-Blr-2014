package com.example.hello;

import android.app.Activity;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class FormViewActivity extends Activity{

	WebView webView;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		// TODO Auto-generated method stub
//		super.onCreate(savedInstanceState);
		setContentView(R.layout.formview);
		SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
		
		String link	 = prefs.getString("link", "");
		final String lat = prefs.getString("lat", "");
		final String lon = prefs.getString("lon", "");
		final String name = prefs.getString("name", "");
		webView = (WebView) findViewById(R.id.webview);
		webView.getSettings().setJavaScriptEnabled(true);     
	       webView.getSettings().setLoadWithOverviewMode(true);
	       webView.getSettings().setUseWideViewPort(true);        
	        webView.setWebViewClient(new WebViewClient(){

	            @Override
	            public boolean shouldOverrideUrlLoading(WebView view, String url) {
//	                progDailog.show();
	                view.loadUrl(url);

	                return true;                
	            }
	            @Override
	            public void onPageFinished(WebView view, final String url) {
//	                progDailog.dismiss();
//	            	webView.loadUrl("javascript:document.querySelectorAll(\"[aria-label=\"Longitude\"]\").innerHTML=\"1\";");
	            	webView.loadUrl("javascript:document.querySelector(\"[aria-label='Longitude  ']\").setAttribute('value','"+lon+"');document.querySelector(\"[aria-label='Latitude  ']\").setAttribute('value','"+lat+"');document.querySelector(\"[aria-label='Your name  ']\").setAttribute('value','"+name+"');");
	            }
	        });

	        webView.loadUrl("http://"+link);

	}
	
	

}
