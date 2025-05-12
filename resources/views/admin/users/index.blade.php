@extends('admin.layout')

@section('title', 'Users | Medical Clinic')

@section('content')

<main class="main-content">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="flash-message">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Recent Users -->
        <div class="page-header-with-actions">
            <div>
                <h3 class="chart-title">Recent Users</h3>
                <p class="text-muted">Manage all users in the system</p>
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="all">All Users</div>
            <div class="tab" data-tab="patients">Patients</div>
            <div class="tab" data-tab="doctors">Doctors</div>
            <div class="tab" data-tab="staff">Staff</div>
        </div>

        <div class="filters-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="user-search" placeholder="Search users...">
            </div>
            <select class="filter-select" id="role-filter">
                <option value="all">All Roles</option>
                <option value="patient">Patients</option>
                <option value="doctor">Doctors</option>
                <option value="admin">Administrators</option>
                <option value="staff">Staff</option>
            </select>
            <button class="btn btn-outline" id="more-filters-btn">
                <i class="fas fa-filter"></i> More Filters
            </button>
        </div>

        <div class="table-container">
            <table class="data-table" id="users-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-role="patient">
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">
                                    <span class="avatar-fallback">EW</span>
                                </div>
                                <div>Emma Wilson</div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-cell">
                                <div>emma.wilson@example.com</div>
                                <div class="text-muted">+1 (555) 123-4567</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-outline">Patient</span>
                        </td>
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td>Mar 15, 2025</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn-icon dropdown-toggle">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-eye"></i> View Profile
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Send Message
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-danger">
                                        <i class="fas fa-ban"></i> Deactivate
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr data-role="doctor">
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">
                                    <span class="avatar-fallback">MC</span>
                                </div>
                                <div>Dr. Michael Chen</div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-cell">
                                <div>michael.chen@example.com</div>
                                <div class="text-muted">+1 (555) 234-5678</div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-outline">Doctor</span>
                        </td>
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td>Jan 10, 2025</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn-icon dropdown-toggle">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-eye"></i> View Profile
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-envelope"></i> Send Message
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-danger">
                                        <i class="fas fa-ban"></i> Deactivate
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-info">
                Showing 1 to 2 of 2 entries
            </div>
            <div class="pagination">
                <button class="pagination-btn" disabled>Previous</button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">Next</button>
            </div>
        </div>

        <!-- More Filters Modal -->
        <div class="modal" id="more-filters-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>More Filters</h3>
                    <button class="close-modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status-filter">Status</label>
                        <select id="status-filter" class="form-control">
                            <option value="all">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="join-start-date">Joined From</label>
                            <input type="date" id="join-start-date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="join-end-date">Joined To</label>
                            <input type="date" id="join-end-date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sort By</label>
                        <div class="radio-container">
                            <label class="radio-label">
                                <input type="radio" name="sort-by" value="name" checked> Name
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="sort-by" value="joined"> Joined Date
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="sort-by" value="role"> Role
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="apply-filters">Apply Filters</button>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Tab Switching
            const tabs = document.querySelectorAll('.tab');
            const rows = document.querySelectorAll('#users-table tbody tr');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const tabType = tab.getAttribute('data-tab');
                    rows.forEach(row => {
                        const role = row.getAttribute('data-role');
                        if (tabType === 'all' || (tabType === 'patients' && role === 'patient') || 
                            (tabType === 'doctors' && role === 'doctor') || 
                            (tabType === 'staff' && role === 'staff')) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });

            // Dropdown Toggle
            document.querySelectorAll('.dropdown-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const dropdownMenu = button.nextElementSibling;
                    const isVisible = dropdownMenu.classList.contains('show');

                    // Close all dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });

                    // Toggle current dropdown
                    if (!isVisible) {
                        dropdownMenu.classList.add('show');
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (event) => {
                if (!event.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Search Functionality
            const searchInput = document.getElementById('user-search');
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const userName = row.querySelector('.user-cell div:last-child').textContent.toLowerCase();
                    const email = row.querySelector('.contact-cell div:first-child').textContent.toLowerCase();
                    if (userName.includes(searchTerm) || email.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Role Filter
            const roleFilter = document.getElementById('role-filter');
            roleFilter.addEventListener('change', () => {
                const selectedRole = roleFilter.value;
                rows.forEach(row => {
                    const role = row.getAttribute('data-role');
                    if (selectedRole === 'all' || role === selectedRole) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Modal Toggle
            const moreFiltersBtn = document.getElementById('more-filters-btn');
            const moreFiltersModal = document.getElementById('more-filters-modal');
            const closeModal = moreFiltersModal.querySelector('.close-modal');
            const cancelBtn = moreFiltersModal.querySelector('[data-dismiss="modal"]');
            const applyFiltersBtn = document.getElementById('apply-filters');

            moreFiltersBtn.addEventListener('click', () => {
                moreFiltersModal.style.display = 'flex';
            });

            closeModal.addEventListener('click', () => {
                moreFiltersModal.style.display = 'none';
            });

            cancelBtn.addEventListener('click', () => {
                moreFiltersModal.style.display = 'none';
            });

            // Apply Filters (Placeholder)
            applyFiltersBtn.addEventListener('click', () => {
                const statusFilter = document.getElementById('status-filter').value;
                const joinStartDate = document.getElementById('join-start-date').value;
                const joinEndDate = document.getElementById('join-end-date').value;
                const sortBy = document.querySelector('input[name="sort-by"]:checked').value;

                console.log('Filters Applied:', { statusFilter, joinStartDate, joinEndDate, sortBy });
                moreFiltersModal.style.display = 'none';

                // Implement filtering/sorting logic here
                // Example: Filter rows based on status, date range, and sort
            });

            // Close modal when clicking outside
            moreFiltersModal.addEventListener('click', (event) => {
                if (event.target === moreFiltersModal) {
                    moreFiltersModal.style.display = 'none';
                }
            });
        });
    </script>

@endsection