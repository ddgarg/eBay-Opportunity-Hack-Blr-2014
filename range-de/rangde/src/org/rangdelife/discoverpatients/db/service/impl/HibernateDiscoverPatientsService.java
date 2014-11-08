/**
 * 
 */
package org.rangdelife.discoverpatients.db.service.impl;

import java.util.List;

import org.rangdelife.discoverpatients.db.service.DiscoverPatientsDBService;
import org.rangdelife.discoverpatients.entity.DiscoverPatientsDetails;
import org.springframework.orm.hibernate3.support.HibernateDaoSupport;

/**
 * @author RangDe
 * 
 */
@SuppressWarnings("unchecked")
public class HibernateDiscoverPatientsService extends HibernateDaoSupport implements
		DiscoverPatientsDBService {

	@Override
	public List<DiscoverPatientsDetails> fetchPatientDetails() {
		// TODO Auto-generated method stub
		return null;
	}

	
}
