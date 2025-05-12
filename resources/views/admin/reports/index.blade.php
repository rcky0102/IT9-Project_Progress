@extends('admin.layout')

@section('title', 'Reports | Medical Clinic')

@section('content')

<!-- Main Content -->
            <main class="main-content">
                <div class="page-header-with-actions">
                    <div>
                        <h1>Reports</h1>
                        <p class="text-muted">Generate and view clinic reports</p>
                    </div>
                    <div class="header-buttons">
                        <button class="btn btn-outline">
                            <i class="fas fa-calendar"></i> Schedule Reports
                        </button>
                        <button class="btn btn-primary" id="generate-report-btn">
                            <i class="fas fa-download"></i> Generate Report
                        </button>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active">Financial</div>
                    <div class="tab">Patient</div>
                    <div class="tab">Appointment</div>
                    <div class="tab">Doctor</div>
                    <div class="tab">Inventory</div>
                </div>

                <div class="filters-container">
                    <div class="date-range">
                        <label>Date Range:</label>
                        <input type="date" class="filter-date" value="2025-04-01">
                        <span>to</span>
                        <input type="date" class="filter-date" value="2025-05-01">
                    </div>
                    <select class="filter-select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly" selected>Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                    <button class="btn btn-outline">
                        <i class="fas fa-filter"></i> Apply Filters
                    </button>
                </div>

                <!-- Report Cards -->
                <div class="dashboard-cards">
                    <div class="report-card">
                        <div class="report-card-header">
                            <h3>Revenue Overview</h3>
                            <div class="report-actions">
                                <button class="btn-icon">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-placeholder">
                            <p>Revenue trend chart would be displayed here</p>
                        </div>
                        <div class="report-summary">
                            <div class="summary-item">
                                <div class="summary-label">Total Revenue</div>
                                <div class="summary-value">$45,289</div>
                                <div class="summary-change positive">+15% from last month</div>
                            </div>
                            <div class="summary-item">
                                <div class="summary-label">Expenses</div>
                                <div class="summary-value">$28,450</div>
                                <div class="summary-change negative">+8% from last month</div>
                            </div>
                            <div class="summary-item">
                                <div class="summary-label">Net Profit</div>
                                <div class="summary-value">$16,839</div>
                                <div class="summary-change positive">+22% from last month</div>
                            </div>
                        </div>
                    </div>

                    <div class="report-card">
                        <div class="report-card-header">
                            <h3>Appointment Statistics</h3>
                            <div class="report-actions">
                                <button class="btn-icon">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-placeholder">
                            <p>Appointment statistics chart would be displayed here</p>
                        </div>
                        <div class="report-summary">
                            <div class="summary-item">
                                <div class="summary-label">Total Appointments</div>
                                <div class="summary-value">156</div>
                                <div class="summary-change positive">+8% from last month</div>
                            </div>
                            <div class="summary-item">
                                <div class="summary-label">Completed</div>
                                <div class="summary-value">128</div>
                                <div class="summary-change positive">+12% from last month</div>
                            </div>
                            <div class="summary-item">
                                <div class="summary-label">Cancelled</div>
                                <div class="summary-value">18</div>
                                <div class="summary-change positive">-5% from last month</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report Tables -->
                <div class="report-section">
                    <div class="report-header">
                        <h3>Top Services by Revenue</h3>
                        <div class="report-actions">
                            <button class="btn-icon">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-icon">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Category</th>
                                    <th>Appointments</th>
                                    <th>Revenue</th>
                                    <th>% of Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cardiology Consultation</td>
                                    <td>Consultation</td>
                                    <td>45</td>
                                    <td>$9,000</td>
                                    <td>19.9%</td>
                                </tr>
                                <tr>
                                    <td>MRI Scan</td>
                                    <td>Procedure</td>
                                    <td>28</td>
                                    <td>$8,400</td>
                                    <td>18.5%</td>
                                </tr>
                                <tr>
                                    <td>General Consultation</td>
                                    <td>Consultation</td>
                                    <td>52</td>
                                    <td>$7,800</td>
                                    <td>17.2%</td>
                                </tr>
                                <tr>
                                    <td>Blood Test - Complete Panel</td>
                                    <td>Test</td>
                                    <td>38</td>
                                    <td>$4,560</td>
                                    <td>10.1%</td>
                                </tr>
                                <tr>
                                    <td>X-Ray - Chest</td>
                                    <td>Procedure</td>
                                    <td>25</td>
                                    <td>$4,500</td>
                                    <td>9.9%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="report-section">
                    <div class="report-header">
                        <h3>Doctor Performance</h3>
                        <div class="report-actions">
                            <button class="btn-icon">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-icon">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Specialty</th>
                                    <th>Appointments</th>
                                    <th>Revenue Generated</th>
                                    <th>Patient Satisfaction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                <span class="avatar-fallback">MC</span>
                                            </div>
                                            <div>Dr. Michael Chen</div>
                                        </div>
                                    </td>
                                    <td>Cardiology</td>
                                    <td>42</td>
                                    <td>$12,600</td>
                                    <td>95%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                <span class="avatar-fallback">SJ</span>
                                            </div>
                                            <div>Dr. Sarah Johnson</div>
                                        </div>
                                    </td>
                                    <td>Pediatrics</td>
                                    <td>38</td>
                                    <td>$9,500</td>
                                    <td>98%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                <span class="avatar-fallback">RW</span>
                                            </div>
                                            <div>Dr. Robert Williams</div>
                                        </div>
                                    </td>
                                    <td>Neurology</td>
                                    <td>32</td>
                                    <td>$8,000</td>
                                    <td>92%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                <span class="avatar-fallback">EM</span>
                                            </div>
                                            <div>Dr. Emily Martinez</div>
                                        </div>
                                    </td>
                                    <td>Dermatology</td>
                                    <td>35</td>
                                    <td>$7,000</td>
                                    <td>96%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Generate Report Modal -->
                <div class="modal" id="generate-report-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Generate Report</h3>
                            <button class="close-modal"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="report-type">Report Type</label>
                                <select id="report-type" class="form-control">
                                    <option value="">Select report type</option>
                                    <option value="financial">Financial Report</option>
                                    <option value="patient">Patient Statistics</option>
                                    <option value="appointment">Appointment Analytics</option>
                                    <option value="doctor">Doctor Performance</option>
                                    <option value="inventory">Inventory Status</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="report-start-date">Start Date</label>
                                    <input type="date" id="report-start-date" class="form-control" value="2025-04-01">
                                </div>
                                <div class="form-group">
                                    <label for="report-end-date">End Date</label>
                                    <input type="date" id="report-end-date" class="form-control" value="2025-05-01">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="report-format">Format</label>
                                <select id="report-format" class="form-control">
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                    <option value="csv">CSV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Include Sections</label>
                                <div class="checkbox-container">
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked> Summary
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked> Charts & Graphs
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox" checked> Detailed Tables
                                    </label>
                                    <label class="checkbox-label">
                                        <input type="checkbox"> Comparison with Previous Period
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="report-notes">Notes (Optional)</label>
                                <textarea id="report-notes" class="form-control" rows="3" placeholder="Enter any notes to include in the report"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Generate Report</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtns = document.querySelectorAll('.dropdown .btn-icon, .dropdown .avatar-btn');
            
            dropdownBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;
                    menu.classList.toggle('show');
                    
                    // Close other dropdowns
                    dropdownBtns.forEach(otherBtn => {
                        if (otherBtn !== btn) {
                            const otherMenu = otherBtn.nextElementSibling;
                            if (otherMenu) {
                                otherMenu.classList.remove('show');
                            }
                        }
                    });
                });
            });
            
            // Close dropdowns when clicking outside
            window.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            });

            // Tab functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Modal functionality
            const generateReportBtn = document.getElementById('generate-report-btn');
            const generateReportModal = document.getElementById('generate-report-modal');
            const closeModal = document.querySelector('.close-modal');
            const cancelBtn = document.querySelector('[data-dismiss="modal"]');
            
            generateReportBtn.addEventListener('click', function() {
                generateReportModal.style.display = 'flex';
            });
            
            closeModal.addEventListener('click', function() {
                generateReportModal.style.display = 'none';
            });
            
            cancelBtn.addEventListener('click', function() {
                generateReportModal.style.display = 'none';
            });
            
            window.addEventListener('click', function(e) {
                if (e.target === generateReportModal) {
                    generateReportModal.style.display = 'none';
                }
            });
        });
    </script>

@endsection