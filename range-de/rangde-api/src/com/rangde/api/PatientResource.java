package com.rangde.api;

import java.util.ArrayList;
import java.util.List;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Request;
import javax.ws.rs.core.UriInfo;

import com.rangde.api.model.Patient;

@Path("/patient")
public class PatientResource {

	@Context
	UriInfo uriInfo;
	@Context
	Request request;

	@GET
	@Path("{id}")
	@Produces({ MediaType.APPLICATION_JSON })
	public Patient getPatient(@PathParam("id") Integer id) {
		System.out.println("Fetching patient:" + id);
		Patient patient = SearchResource.patients.get(id);
		return patient;
	}

}

