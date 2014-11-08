package org.rangdelife.discoverpatients.db.service;

import java.util.List;

import org.rangdelife.discoverpatients.entity.DiscoverPatientsDetails;

public interface DiscoverPatientsDBService {

	public List<DiscoverPatientsDetails> fetchPatientDetails();
		
}
