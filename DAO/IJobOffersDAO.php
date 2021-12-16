<?php
    namespace DAO;

    use Models\JobOffers as JobOffers;

    interface IJobOffersDAO
    {
        function Add(JobOffers $jobOffers);
        function GetAll();

    }
?>