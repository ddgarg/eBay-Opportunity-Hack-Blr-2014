package com.rangde.api;

import java.util.ArrayList;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Request;
import javax.ws.rs.core.UriInfo;

import com.rangde.api.model.Donation;

@Path("/donation/patient")
public class DonationResource {
	
	@Context
	UriInfo uriInfo;
	@Context
	Request request;

	@GET
	@Path("{id}")
	@Produces({ MediaType.APPLICATION_JSON })
	public List<Donation> getDonation(@PathParam("id") Integer id) {
		List<Donation> donations = new ArrayList<Donation>();
		System.out.println("Fetching donation for patient:" + id);
		for(int i = 0; i<3; i++){
			donations.add(new Donation(id, i + 1000, "Suresh", "Get well soon!", "3 days ago"));
		}
		return donations;
	}

}
