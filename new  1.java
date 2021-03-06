package com.example.kruthika.busmodule;

import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;

import java.io.IOException;

public class AndroidGPSTrackingActivity extends Activity {

    Button btnShowLocation;

    // GPSTracker class
    GPSTracker gps;
    String response;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btnShowLocation = (Button) findViewById(R.id.btnShowLocation);

        // show location button click event
        btnShowLocation.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View arg0) {
                // create class object
                gps = new GPSTracker(AndroidGPSTrackingActivity.this);

                // check if GPS enabled
                if(gps.canGetLocation()){

                    final Handler h=new Handler();
                    Runnable r=new Runnable() {
                        @Override
                        public void run() {
                            double latitude = gps.getLatitude();
                            double longitude = gps.getLongitude();

                            // \n is for new line
                            //Toast.makeText(getApplicationContext(), "Your Location is - \nLat: " + latitude + "\nLong: " + longitude, Toast.LENGTH_SHORT).show();


                            Thread thread=new Thread(new Runnable() {
                                @Override
                                public void run() {
                                    HttpClient httpClient=new DefaultHttpClient();
                                    HttpPost httpGet=new HttpPost("http://localhost/IBAS/home.php");
                                    try {
										// Add your data
										List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>(2);
										nameValuePair.add(new BasicNameValuePair(Double.toString(latitude),Double.toString(longitude)));

																			try {
										  httpPost.setEntity(new UrlEncodedFormEntity(nameValuePair));
									 
									} catch (UnsupportedEncodingException e) 
									{
										 e.printStackTrace();
									}

										// Execute HTTP Post Request

																				try {
											HttpResponse response = httpClient.execute(httpPost);
											// write response to log
											Log.d("Http Post Response:", response.toString());
										} catch (ClientProtocolException e) {
											// Log exception
											e.printStackTrace();
										} catch (IOException e) {
											// Log exception
											e.printStackTrace();
										}

                            });
                            thread.start();
                            try {
                                thread.join();
                            } catch (InterruptedException e) {
                                e.printStackTrace();
                            }
                            Toast.makeText(getApplicationContext(),response,Toast.LENGTH_LONG).show();




                            h.postDelayed(this, 50000);
                        }
                    };
                    h.post(r);


                }else{
                    // can't get location
                    // GPS or Network is not enabled
                    // Ask user to enable GPS/network in settings
                    gps.showSettingsAlert();
                }

            }
        });
    }

}