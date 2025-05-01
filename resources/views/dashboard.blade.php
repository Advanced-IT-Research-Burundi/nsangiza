@extends('layouts.template')
@section('content')
<div class="col-lg-10 ps-lg-0">

    <!-- Content Container -->
    <div class="content-container">
        <!-- Tabs Navigation -->
        <div class="tabs">
            <a href="{{ route('dashboard') }}" class="tab {{ !isset($activeTab) || $activeTab == 'upload' ? 'active' : '' }}">Upload Files</a>
            <a href="{{ route('dashboard.recent') }}" class="tab {{ isset($activeTab) && $activeTab == 'recent' ? 'active' : '' }}">Recent Files</a>
            <a href="{{ route('dashboard.shared') }}" class="tab {{ isset($activeTab) && $activeTab == 'shared' ? 'active' : '' }}">Shared Files</a>
            <a href="{{ route('dashboard.all') }}" class="tab {{ isset($activeTab) && $activeTab == 'all' ? 'active' : '' }}">All Files</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show success-alert" role="alert">
            <div class="success-content">
                <div class="success-icon">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div class="success-message">
                    <h5>Téléchargement réussi !</h5>
                    <p>{{ session('success') }}</p>

                    <!-- QR Code et lien de partage -->
                    @if(session('fileId') && session('fileName'))
                    <div class="share-success-container mt-3">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="qr-success-container">
                                    <div id="successQrcode"></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="share-link-container">
                                    <div class="input-group">
                                        <input type="text" class="form-control success-share-link" value="{{ url('/dashboard/download/'.session('fileId')) }}" readonly>
                                        <button class="btn btn-outline-success copy-success-btn" type="button">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Partagez ce lien ou scannez le QR code</small>
                                </div>
                            </div>
                        </div>
                        <div class="share-options mt-4">
                            <p class="text-muted mb-2">Partager via</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary share-btn" data-platform="email">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="btn btn-outline-primary share-btn" data-platform="whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button class="btn btn-outline-primary share-btn" data-platform="telegram">
                                    <i class="fab fa-telegram"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <div>
                    <strong>Erreur !</strong> {{ session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(!isset($activeTab) || $activeTab == 'upload')
        <!-- Zone d'upload améliorée avec barre de progression -->
        <form action="{{ route('dashboard.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3 class="upload-text">Déposez vos fichiers ici ou cliquez pour parcourir</h3>

                <!-- Barre de progression cachée par défaut -->
                <div class="progress upload-progress mt-3" style="display: none;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>

                <div class="upload-status mt-2" style="display: none;">
                    <span class="current-file"></span>
                    <span class="upload-percentage">0%</span>
                </div>

                <div class="mt-4 upload-buttons">
                    <button type="button" class="btn btn-primary btn-lg px-4" onclick="document.getElementById('fileInput').click();">
                        <i class="fas fa-upload me-2"></i> Choisir des fichiers
                    </button>
                    <input type="file" id="fileInput" name="files[]" class="d-none" multiple>
                </div>
            </div>
        </form>
        @endif

        <!-- Section des fichiers -->
        <div class="files-header">
            <h2 class="section-title">
                @if(isset($activeTab) && $activeTab == 'shared')
                    Partagés avec moi
                @elseif(isset($activeTab) && $activeTab == 'all')
                    Tous les fichiers
                @else
                    Fichiers récents
                @endif
            </h2>
            <div class="view-toggle">
                <button class="toggle-btn active" id="gridView"><i class="fas fa-th"></i></button>
                <button class="toggle-btn" id="listView"><i class="fas fa-list"></i></button>
            </div>
        </div>


        <div class="files-grid">
            @if(isset($activeTab) && $activeTab == 'shared')
                @forelse($sharedFiles as $file)
                <div class="file-card">
                    <div class="file-actions">
                        <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                        <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>

                        <a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFileModal-{{ $file->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                    <div class="file-icon {{ $file->icon_class }}">
                        <i class="{{ $file->file_icon }}"></i>
                    </div>
                    <div class="file-name">{{ $file->name }}</div>
                    <div class="file-info">
                        <span>{{ $file->formatted_size }}</span>
                        <span>{{ $file->created_at->format('M d') }}</span>
                    </div>
                </div>
                 <!-- Delete File Modal -->
                 <div class="modal fade" id="deleteFileModal-{{ $file->id }}" tabindex="-1" aria-labelledby="deleteFileModalLabel-{{ $file->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteFileModalLabel-{{ $file->id }}">Supprimer le fichier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer <strong>{{ $file->name }}</strong> ? Cette action est irréversible.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal de partage avec QR code -->
                <div class="modal fade" id="shareFileModal" tabindex="-1" aria-labelledby="shareFileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="shareFileModalLabel">Partager le fichier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="qr-code-container mb-3 mb-md-0">
                                            <div id="qrcode"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="share-details">
                                            <h6 class="file-name-display mb-3"></h6>

                                            <div class="copy-link-container">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control share-link" readonly>
                                                    <button class="btn btn-primary copy-btn" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="share-options mt-4">
                                                <p class="text-muted mb-2">Partager via</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-primary share-btn" data-platform="email">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="whatsapp">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="telegram">
                                                        <i class="fab fa-telegram"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No shared files found.</div>
                    </div>
                @endforelse
            @elseif(isset($activeTab) && $activeTab == 'all')
                @forelse($allFiles as $file)
                <div class="file-card">
                    <div class="file-actions">
                        <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                        <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>

                        <a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFileModal-{{ $file->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                    <div class="file-icon {{ $file->icon_class }}">
                        <i class="{{ $file->file_icon }}"></i>
                    </div>
                    <div class="file-name">{{ $file->name }}</div>
                    <div class="file-info">
                        <span>{{ $file->formatted_size }}</span>
                        <span>{{ $file->created_at->format('M d') }}</span>
                    </div>
                </div>
                 <!-- Delete File Modal -->
                 <div class="modal fade" id="deleteFileModal-{{ $file->id }}" tabindex="-1" aria-labelledby="deleteFileModalLabel-{{ $file->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteFileModalLabel-{{ $file->id }}">Supprimer le fichier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer <strong>{{ $file->name }}</strong> ? Cette action est irréversible.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal de partage avec QR code -->
                <div class="modal fade" id="shareFileModal" tabindex="-1" aria-labelledby="shareFileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="shareFileModalLabel">Partager le fichier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="qr-code-container mb-3 mb-md-0">
                                            <div id="qrcode"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="share-details">
                                            <h6 class="file-name-display mb-3"></h6>

                                            <div class="copy-link-container">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control share-link" readonly>
                                                    <button class="btn btn-primary copy-btn" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="share-options mt-4">
                                                <p class="text-muted mb-2">Partager via</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-primary share-btn" data-platform="email">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="whatsapp">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="telegram">
                                                        <i class="fab fa-telegram"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Aucun fichier trouvé. Téléversez un fichier pour commencer.</div>
                </div>
            @endforelse

            @else
                @forelse($recentFiles as $file)
                    <div class="file-card">
                        <div class="file-actions">
                            <a href="{{ route('dashboard.download', $file->id) }}" class="action-btn"><i class="fas fa-download"></i></a>
                            <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#shareFileModal" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fas fa-share-alt"></i></a>

                            <a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFileModal-{{ $file->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                        <div class="file-icon {{ $file->icon_class }}">
                            <i class="{{ $file->file_icon }}"></i>
                        </div>
                        <div class="file-name">{{ $file->name }}</div>
                        <div class="file-info">
                            <span>{{ $file->formatted_size }}</span>
                            <span>{{ $file->created_at->format('M d') }}</span>
                        </div>
                    </div>
                    <!-- Delete File Modal -->
                    <div class="modal fade" id="deleteFileModal-{{ $file->id }}" tabindex="-1" aria-labelledby="deleteFileModalLabel-{{ $file->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteFileModalLabel-{{ $file->id }}">Supprimer le fichier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer <strong>{{ $file->name }}</strong> ? Cette action est irréversible.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- modal de partage avec QR code -->
                <div class="modal fade" id="shareFileModal" tabindex="-1" aria-labelledby="shareFileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="shareFileModalLabel">Partager le fichier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <div class="qr-code-container mb-3 mb-md-0">
                                            <div id="qrcode"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="share-details">
                                            <h6 class="file-name-display mb-3"></h6>

                                            <div class="copy-link-container">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control share-link" readonly>
                                                    <button class="btn btn-primary copy-btn" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="share-options mt-4">
                                                <p class="text-muted mb-2">Partager via</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-primary share-btn" data-platform="email">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="whatsapp">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary share-btn" data-platform="telegram">
                                                        <i class="fab fa-telegram"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No recent files found. Upload a file to get started.</div>
                    </div>
                @endforelse
            @endif
        </div>

        <!-- Activité récente -->
    <div class="activity-section">
        <div class="activity-header">
            <h2 class="section-title">Activité récente</h2>
            {{-- <a href="#" class="btn btn-outline-primary btn-sm">Voir tout</a> --}}
        </div>

        <ul class="activity-list">
            @forelse($recentActivities as $activity)
                <li class="activity-item">
                    <div class="activity-icon {{ $activity->icon_class }}">
                        {!! $activity->activity_icon !!}
                    </div>
                    <div class="activity-details">
                        <div class="activity-text">
                            @if($activity->user_id == Auth::id())
                                Vous avez <strong>{{ $activity->action }}é</strong> {{ $activity->file->name }}
                            @else
                                {{ $activity->user->name }} a <strong>{{ $activity->action }}é</strong> {{ $activity->file->name }}
                            @endif
                            @if($activity->details)
                                {{ $activity->details }}
                            @endif
                        </div>
                        <div class="activity-time">
                            {{ $activity->created_at->diffForHumans() }}
                        </div>
                    </div>
                </li>
            @empty
                <li class="activity-item">
                    <div class="activity-details">
                        <div class="activity-text">Aucune activité récente.</div>
                    </div>
                </li>
            @endforelse

        </div>
    </div>



@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>


    document.addEventListener('DOMContentLoaded', function() {
        // Configuration pour le glisser-déposer
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const uploadForm = document.getElementById('uploadForm');
        const progressBar = document.querySelector('.progress');
        const progressBarInner = document.querySelector('.progress-bar');
        const uploadStatus = document.querySelector('.upload-status');
        const currentFileSpan = document.querySelector('.current-file');
        const uploadPercentage = document.querySelector('.upload-percentage');

        // Fonction pour gérer le glisser-déposer
        if (uploadArea) {
            // Empêcher le comportement par défaut
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Ajouter/supprimer la classe pour le style
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('dragging');
            }

            function unhighlight() {
                uploadArea.classList.remove('dragging');
            }

            // Gérer le drop
            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                handleFiles(files);
            }

            // Gérer le clic sur la zone
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });

            // Gérer la sélection de fichiers
            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                if (files.length > 0) {
                    showProgressBar();
                    simulateUpload(files);
                }
            }

            // Simuler l'upload avec la barre de progression
            function showProgressBar() {
                progressBar.style.display = 'flex';
                uploadStatus.style.display = 'block';
                document.querySelector('.upload-buttons').style.display = 'none';
            }

            function simulateUpload(files) {
                let progress = 0;
                const totalFiles = files.length;
                let currentFileIndex = 0;

                // Afficher le nom du premier fichier
                if (files[0]) {
                    currentFileSpan.textContent = `Téléchargement de ${files[0].name} (${formatFileSize(files[0].size)})`;
                }

                const interval = setInterval(() => {
                    progress += 1;

                    // Calculer le progrès par fichier
                    if (progress >= 100 && currentFileIndex < totalFiles - 1) {
                        currentFileIndex++;
                        progress = 0;
                        currentFileSpan.textContent = `Téléchargement de ${files[currentFileIndex].name} (${formatFileSize(files[currentFileIndex].size)})`;
                    }

                    progressBarInner.style.width = progress + '%';
                    progressBarInner.setAttribute('aria-valuenow', progress);
                    uploadPercentage.textContent = progress + '%';

                    if (progress >= 100 && currentFileIndex >= totalFiles - 1) {
                        clearInterval(interval);
                        setTimeout(() => {
                            currentFileSpan.textContent = 'Finalisation...';
                            setTimeout(() => {
                                // Soumettre le formulaire après la simulation
                                uploadForm.submit();
                            }, 500);
                        }, 400);
                    }
                }, 50);
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        }

        // Générer le QR code dans le message de succès
        const successQrcode = document.getElementById('successQrcode');
        if (successQrcode) {
            const shareLink = document.querySelector('.success-share-link').value;

            new QRCode(successQrcode, {
                text: shareLink,
                width: 120,
                height: 120,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            // Fonctionnalité de copie pour le lien de succès
            const copySuccessBtn = document.querySelector('.copy-success-btn');
            const successShareLink = document.querySelector('.success-share-link');

            if (copySuccessBtn && successShareLink) {
                copySuccessBtn.addEventListener('click', function() {
                    successShareLink.select();
                    document.execCommand('copy');

                    copySuccessBtn.classList.add('copied');
                    copySuccessBtn.innerHTML = '<i class="fas fa-check"></i>';

                    setTimeout(() => {
                        copySuccessBtn.classList.remove('copied');
                        copySuccessBtn.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 2000);
                });
            }
        }
        // View toggle functionality
        const gridViewBtn = document.getElementById('gridView');
        const listViewBtn = document.getElementById('listView');
        const filesContainer = document.querySelector('.files-grid');

        if (gridViewBtn && listViewBtn) {
            gridViewBtn.addEventListener('click', function() {
                filesContainer.classList.remove('list-view');
                filesContainer.classList.add('grid-view');
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                localStorage.setItem('fileViewMode', 'grid');
            });

            listViewBtn.addEventListener('click', function() {
                filesContainer.classList.remove('grid-view');
                filesContainer.classList.add('list-view');
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                localStorage.setItem('fileViewMode', 'list');
            });

            // Load saved view preference
            const savedViewMode = localStorage.getItem('fileViewMode');
            if (savedViewMode === 'list') {
                listViewBtn.click();
            } else {
                gridViewBtn.click();
            }
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const shareModal = document.getElementById('shareFileModal');

        if (shareModal) {
            shareModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const fileId = button.getAttribute('data-file-id');
                const fileName = button.getAttribute('data-file-name');

                // Afficher le nom du fichier
                const fileNameDisplay = shareModal.querySelector('.file-name-display');
                fileNameDisplay.textContent = fileName;

                // Créer le lien de partage
                const shareLink = `${window.location.origin}/dashboard/download/${fileId}`;
                const shareLinkInput = shareModal.querySelector('.share-link');
                shareLinkInput.value = shareLink;

                // Générer le QR code
                const qrcodeContainer = document.getElementById('qrcode');
                qrcodeContainer.innerHTML = '';

                new QRCode(qrcodeContainer, {
                    text: shareLink,
                    width: 180,
                    height: 180,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                // Fonctionnalité de copie
                const copyBtn = shareModal.querySelector('.copy-btn');
                copyBtn.addEventListener('click', function() {
                    shareLinkInput.select();
                    document.execCommand('copy');

                    copyBtn.classList.add('copied');
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';

                    setTimeout(() => {
                        copyBtn.classList.remove('copied');
                        copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 2000);
                });

                // Fonctionnalités de partage sur les plateformes
                const shareBtns = shareModal.querySelectorAll('.share-btn');
                shareBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const platform = this.getAttribute('data-platform');
                        let shareUrl;

                        switch(platform) {
                            case 'email':
                                shareUrl = `mailto:?subject=Partage du fichier: ${fileName}&body=Voici le lien pour accéder au fichier ${fileName}: ${shareLink}`;
                                break;
                            case 'whatsapp':
                                shareUrl = `https://wa.me/?text=${encodeURIComponent(`Voici le fichier ${fileName}: ${shareLink}`)}`;
                                break;
                            case 'telegram':
                                shareUrl = `https://t.me/share/url?url=${encodeURIComponent(shareLink)}&text=${encodeURIComponent(`Voici le fichier ${fileName}`)}`;
                                break;
                        }

                        if (shareUrl) {
                            window.open(shareUrl, '_blank');
                        }
                    });
                });
            });
        }
    });
    </script>
@endpush

@push('styles')
<style>
    .qr-code-container {
        background-color: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #qrcode {
        width: 180px;
        height: 180px;
    }

    .share-details {
        padding: 10px;
    }

    .file-name-display {
        font-weight: 600;
        color: #333;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .copy-link-container {
        margin-top: 1rem;
    }

    .copy-btn {
        transition: all 0.2s;
    }

    .copy-btn.copied {
        background-color: #28a745;
        border-color: #28a745;
    }

    .share-options {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.2s;
    }

    .share-btn:hover {
        transform: scale(1.05);
    }
/* Existing styles from the original template */


.content-container {
    padding: 1.5rem;
}

.tabs {
    display: flex;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e3e6f0;
}

.tab {
    padding: 0.75rem 1.5rem;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.2s;
    font-weight: 600;
    text-decoration: none;
    color: inherit;
}

.tab:hover {
    color: var(--accent-color);
}

.tab.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
}

.upload-area {
        border: 2px dashed #3498db;
        border-radius: 10px;
        padding: 40px 20px;
        text-align: center;
        background-color: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        background-color: #e9ecef;
        border-color: #2980b9;
    }

    .upload-area.dragging {
        background-color: #e3f2fd;
        border-color: #1565c0;
    }

    .upload-icon {
        font-size: 60px;
        color: #3498db;
        margin-bottom: 15px;
    }

    .upload-text {
        color: #555;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .upload-progress {
        height: 12px;
        border-radius: 6px;
        margin: 0 auto;
        max-width: 80%;
    }

    .upload-status {
        font-size: 14px;
        color: #666;
    }

    .success-alert {
        border-left: 4px solid #28a745;
    }

    .success-content {
        display: flex;
        align-items: flex-start;
    }

    .success-icon {
        color: #28a745;
        margin-right: 15px;
    }

    .success-message h5 {
        color: #155724;
        margin-bottom: 5px;
    }

    .share-success-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
    }

    .qr-success-container {
        background-color: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        justify-content: center;
    }

    #successQrcode {
        width: 120px;
        height: 120px;
    }

    .share-link-container {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .copy-success-btn {
        transition: all 0.2s;
    }

    .copy-success-btn.copied {
        background-color: #28a745;
        color: white;
    }

    @media (max-width: 767px) {
        .qr-success-container {
            margin-bottom: 15px;
        }
    }

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
}

.files-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #5a5c69;
    margin-bottom: 0;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.toggle-btn {
    border: 1px solid #d1d3e2;
    background-color: white;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
    cursor: pointer;
    transition: all 0.2s;
}

.toggle-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.files-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* List view styles */
.files-grid.list-view {
    display: block;
}

.files-grid.list-view .file-card {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    padding: 0.75rem 1rem;
}

.files-grid.list-view .file-icon {
    font-size: 1.5rem;
    margin-bottom: 0;
    margin-right: 1rem;
    flex-shrink: 0;
}

.files-grid.list-view .file-name {
    flex: 1;
    margin-bottom: 0;
    -webkit-line-clamp: 1;
}

.files-grid.list-view .file-info {
    width: 200px;
    justify-content: flex-end;
    margin-left: 1rem;
}

.files-grid.list-view .file-actions {
    position: static;
    opacity: 1;
    margin-left: 1rem;
}

/* Normal card view styles */
.file-card {
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    background-color: white;
    padding: 1.5rem;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
}

.file-card:hover .file-actions {
    top: 1rem;
    opacity: 1;
}

.file-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: var(--primary-color);
    text-align: center;
}

.file-icon.image { color: var(--success-color); }
.file-icon.document { color: var(--info-color); }
.file-icon.excel { color: var(--success-color); }
.file-icon.video { color: var(--danger-color); }
.file-icon.code { color: var(--warning-color); }

.file-name {
    font-weight: 600;
    margin-bottom: 0.5rem;
    word-break: break-all;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.file-info {
    display: flex;
    justify-content: space-between;
    color: #858796;
    font-size: 0.85rem;
}

.file-actions {
    position: absolute;
    top: -2rem;
    right: 1rem;
    opacity: 0;
    transition: all 0.3s;
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: white;
    color: #5a5c69;
    border: 1px solid #e3e6f0;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.action-btn:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.activity-section {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    padding: 1.5rem;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #e3e6f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f8f9fc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: var(--primary-color);
}

.activity-icon.upload { color: var(--success-color); }
.activity-icon.share { color: var(--info-color); }
.activity-icon.download { color: var(--warning-color); }
.activity-icon.delete { color: var(--danger-color); }

.activity-details {
    flex: 1;
}

.activity-text {
    margin-bottom: 0.25rem;
}

.activity-time {
    font-size: 0.85rem;
    color: #858796;
}

/* File Details Modal */
#fileDetailIcon {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .files-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    }
}

@media (max-width: 768px) {
    .user-profile span {
        display: none;
    }

    .tabs {
        flex-wrap: wrap;
    }

    .tab {
        flex: 1;
        text-align: center;
        padding: 0.5rem;
    }

    .upload-area {
        padding: 1.5rem;
    }

    .upload-icon {
        font-size: 2rem;
    }

    .upload-text {
        font-size: 1rem;
    }

    .files-grid.list-view .file-info {
        display: none;
    }
}
</style>
@endpush
